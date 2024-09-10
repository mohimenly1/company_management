<!-- resources/views/send_message.blade.php -->
@extends('layouts.master')

@section('css')
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection

@section('page-header')
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Chat with {{ $receiver->name }}</h4>
            </div>
        </div>
    </div>
@endsection

@section('content')

<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                <h5>Messages</h5>
                
                <!-- Chat History -->
                <div class="chat-box" style="border: 1px solid #ddd; padding: 10px; height: 400px; overflow-y: scroll;">
                    @foreach($messages as $message)
                        <div style="margin-bottom: 10px;">
                            <strong>{{ $message->sender_id == Auth::id() ? 'You' : $receiver->name }}:</strong>
                            <p>{{ $message->message }}</p>
                            <small>{{ $message->created_at->format('d M Y, h:i A') }}</small>
                        </div>
                    @endforeach
                </div>

                <!-- Send Message Form -->
                <form action="{{ route('teamMembers.sendMessage', ['receiverId' => $receiver->id]) }}" method="POST">
                    @csrf
                    <div class="form-group mt-3">
                        <label for="message">Send a Message</label>
                        <textarea name="message" id="message" class="form-control" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Send</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                width: '100%',
                placeholder: "Select an option",
                allowClear: true
            });
        });
    </script>
@endsection
