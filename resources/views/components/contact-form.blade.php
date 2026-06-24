@props([
    'dark' => false,
    'categories' => [],
])

<form
    id="contactform"
    class="form-contact-us {{ $dark ? 'style-bg-dark-2' : '' }} px-md-15"
>
    @csrf

    @if(!$dark)
    <div class="heading-form text-center">
        <h3 class="title">Need Help For Project!</h3>
        <div class="desc lh-30">We are ready to help your next projects, let's work together</div>
    </div>
    @endif

    <div class="cols mb-20 g-20">
        <fieldset class="item">
            @if($dark)
            <label for="name" class="sub-title body-2 fw-5">Full Name</label>
            @endif
            <fieldset class="position-relative">
                <i class="icon-user"></i>
                <input type="text" name="name" id="name" placeholder="Name" required>
            </fieldset>
        </fieldset>

        <fieldset class="item">
            @if($dark)
            <label for="mail" class="sub-title body-2 fw-5">Email Address</label>
            @endif
            <fieldset class="position-relative">
                <i class="icon-email"></i>
                <input type="email" name="email" id="mail" placeholder="Email" required>
            </fieldset>
        </fieldset>
    </div>

    <div class="cols mb-20 g-20">
        <fieldset class="item">
            @if($dark)
            <label for="phone" class="sub-title body-2 fw-5">Phone Number</label>
            @endif
            <fieldset class="position-relative">
                <i class="icon-phone"></i>
                <input type="text" name="phone" id="phone" placeholder="Phone (optional)">
            </fieldset>
        </fieldset>

        <fieldset class="item">
            @if($dark)
            <label class="sub-title body-2 fw-5">Subject</label>
            @endif
            <fieldset class="position-relative">
                <i class="icon-edit"></i>
                <input type="text" name="subject" id="subject" placeholder="Subject">
            </fieldset>
        </fieldset>
    </div>

    <div class="nice-select mb-20" id="service-select-wrapper">
        <span class="current caption-1">Choose Services</span>
        <ul class="list">
            <li class="option option-all selected focus" data-value="">Choose Services</li>
            @foreach ($categories as $category)
                @foreach ($category->activeServices as $service)
                    <li class="option" data-value="{{ $service->name }}">{{ $service->name }}</li>
                @endforeach
            @endforeach
        </ul>
        <input type="hidden" name="service" id="service-input">
    </div>

    <fieldset class="mb-20">
        @if($dark)
        <label for="message" class="sub-title body-2 fw-5">Message</label>
        @endif
        <textarea name="message" id="message" placeholder="Write message" required></textarea>
    </fieldset>

    <div class="mb-20">
        <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.site_key') }}"></div>
    </div>

    <div id="form-alert" class="mb-20" style="display:none;"></div>

    <button type="submit" class="tf-btn {{ $dark ? '' : 'mx-auto' }}" id="submit-btn">
        <span>Send {{ $dark ? 'Us' : '' }} Message</span>
        <i class="icon-arrow-right"></i>
    </button>
</form>

@once
    @push('scripts')
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {

                document.querySelectorAll('#service-select-wrapper .option').forEach(function (option) {
                    option.addEventListener('click', function () {
                        document.getElementById('service-input').value = this.dataset.value || '';
                    });
                });

                document.getElementById('contactform').addEventListener('submit', function (e) {
                    e.preventDefault();

                    const form = this;
                    const btn = document.getElementById('submit-btn');
                    const alertBox = document.getElementById('form-alert');

                    btn.disabled = true;
                    btn.querySelector('span').textContent = 'Sending...';
                    alertBox.style.display = 'none';

                    fetch('{{ route('contact.store') }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                            'Accept': 'application/json',
                        },
                        body: new FormData(form),
                    })
                    .then(res => res.json())
                    .then(function (res) {
                        alertBox.style.display = 'block';
                        if (res.success) {
                            alertBox.style.color = 'green';
                            alertBox.textContent = res.message;
                            form.reset();
                            document.getElementById('service-input').value = '';
                            document.querySelector('#service-select-wrapper .current').textContent = 'Choose Services';
                            grecaptcha.reset();
                        } else {
                            alertBox.style.color = 'red';
                            alertBox.textContent = res.message;
                            grecaptcha.reset();
                        }
                    })
                    .catch(function () {
                        alertBox.style.display = 'block';
                        alertBox.style.color = 'red';
                        alertBox.textContent = 'Something went wrong. Please try again.';
                        grecaptcha.reset();
                    })
                    .finally(function () {
                        btn.disabled = false;
                        btn.querySelector('span').textContent = 'Send {{ $dark ? 'Us' : '' }} Message';
                    });
                });
            });
        </script>
    @endpush
@endonce
