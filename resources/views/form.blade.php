<form method="POST" action="/contact">
    @csrf

    {!! wiz_captcha_img('math', ['id' => 'captcha-image']) !!}

    <button type="button" onclick="refreshCaptcha()">Refresh</button>

    <input type="text" name="captcha" required autocomplete="off">

    
    @error('captcha')
        <div>{{ $message }}</div>
    @enderror

    <button type="submit">Submit</button>
</form>

<script>
function refreshCaptcha() {
    document.getElementById('captcha-image').src = "{{ route('wiz-captcha.image', ['preset' => 'math']) }}?" + Date.now();
}
</script>