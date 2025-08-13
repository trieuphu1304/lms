<div class="message-header bg-gray d-flex align-items-center justify-content-between p-3 border-bottom">
    <div class="media media-card align-items-center">
        <div class="avatar-sm mr-2">
            <img class="rounded-full img-fluid" src="{{ asset('storage/' . $teacher->avatar) }}" alt="Avatar">
        </div>
        <div class="media-body">
            <h5 class="fs-14 mb-0">{{ $teacher->name }}</h5>
            <small class="text-success">Online</small>
        </div>
    </div>
</div>

<div class="conversation-wrap">
    <div class="conversation-box custom-scrollbar-styled p-3" style="height: 450px; overflow-y: scroll;">
        @foreach ($messages as $msg)
            <div
                class="conversation-item {{ $msg->sender_id == auth()->id() ? 'message-sent' : 'message-reply' }} mb-3">
                <div class="media align-items-center">
                    <div class="avatar-sm flex-shrink-0 mr-3">
                        <img class="rounded-full img-fluid" src="{{ asset('storage/' . $msg->sender->avatar) }}"
                            alt="Avatar">
                    </div>
                    <div class="media-body">
                        <div class="message-body">
                            <p class="mb-1">{{ $msg->message }}</p>
                            <span class="fs-12 text-muted">{{ $msg->created_at->format('H:i d/m') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

{{-- Form gửi tin nhắn --}}
<form method="POST" action="{{ route('chat.send', $courseId) }}" class="p-3 border-top" id="chat-form">
    @csrf
    <input type="hidden" name="receiver_id" value="{{ $teacher->id }}">
    <input type="hidden" name="course_id" value="{{ $courseId }}">

    <div class="input-group mt-3">
        <input type="text" name="message" class="form-control" placeholder="Nhập tin nhắn..." required>
        <div class="input-group-append">
            <button type="submit" class="btn btn-primary">Gửi</button>
        </div>
    </div>
</form>
