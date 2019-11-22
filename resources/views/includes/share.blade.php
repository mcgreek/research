<div>{{ __('poll.share-text') }}</div>
<form action="/poll/share" method="post">
    @csrf
    <textarea name="emails" style='width: 300px; height: 200px;'></textarea>
    <br />
    <input type="submit" name="btn" value="{{ __('poll.share-button') }}" />
</form>