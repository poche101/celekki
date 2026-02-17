<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LiveComment;
use App\Events\MessageSent; // Ensure this is imported
use Carbon\Carbon;

class LiveCommentController extends Controller
{
    /**
     * Fetch all comments for a specific stream.
     */
    public function index($streamId)
    {
        $comments = LiveComment::where('live_stream_id', $streamId)
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($comment) {
                return [
                    'id' => $comment->id,
                    'user_name' => $comment->user_name,
                    'comment_text' => $comment->comment_text,
                    'admin_reply' => $comment->admin_reply,
                    'time_formatted' => $comment->created_at->diffForHumans(),
                ];
            });

        return response()->json($comments);
    }

    /**
     * Store a new comment (Public side).
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'live_stream_id' => 'required|exists:live_streams,id',
            'user_name' => 'required|string|max:255',
            'comment_text' => 'required|string',
        ]);

        $comment = LiveComment::create([
            'live_stream_id' => $validated['live_stream_id'],
            'user_id' => auth()->id(),
            'user_name' => $validated['user_name'],
            'comment_text' => $validated['comment_text'],
            'posted_at' => now(),
        ]);

        // Broadcast to everyone so the message pops up instantly
        // We include admin_reply as null for new messages
        broadcast(new MessageSent(
            $comment->user_name,
            $comment->comment_text,
            null
        ))->toOthers();

        return response()->json([
            'status' => 'success',
            'comment' => [
                'id' => $comment->id,
                'user_name' => $comment->user_name,
                'comment_text' => $comment->comment_text,
                'admin_reply' => null,
                'time_formatted' => 'Just now'
            ]
        ]);
    }

    /**
     * Add or update an admin reply.
     */
    public function reply(Request $request, $id)
    {
        $comment = LiveComment::findOrFail($id);

        $request->validate([
            'admin_reply' => 'required|string'
        ]);

        $comment->update([
            'admin_reply' => $request->admin_reply
        ]);

        // IMPORTANT: Broadcast the reply so the user's UI updates
        // with the "Admin Response" box without a refresh.
        broadcast(new MessageSent(
            $comment->user_name,
            $comment->comment_text,
            $comment->admin_reply
        ));

        return response()->json([
            'message' => 'Reply saved',
            'admin_reply' => $comment->admin_reply
        ]);
    }

    /**
     * Update an existing comment (Admin Edit).
     */
    public function update(Request $request, $id)
    {
        $comment = LiveComment::findOrFail($id);

        $request->validate([
            'comment_text' => 'required|string'
        ]);

        $comment->update([
            'comment_text' => $request->comment_text
        ]);

        // Broadcast the updated text so users see the corrected version immediately
        broadcast(new MessageSent(
            $comment->user_name,
            $comment->comment_text,
            $comment->admin_reply
        ));

        return response()->json([
            'message' => 'Comment updated successfully',
            'comment_text' => $comment->comment_text
        ]);
    }

    /**
     * Delete a comment.
     */
    public function destroy($id)
    {
        $comment = LiveComment::findOrFail($id);

        $comment->delete();

        // Note: For a "real-time delete," you would typically create a
        // separate 'CommentDeleted' event. For now, this removes it
        // from the DB and the admin dashboard on the next sync.
        return response()->json([
            'message' => 'Comment deleted successfully'
        ]);
    }
}
