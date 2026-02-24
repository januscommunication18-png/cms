<x-guest-layout>
    <div class="text-center mb-6">
        <div class="w-16 h-16 mx-auto mb-4 bg-indigo-100 rounded-full flex items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-indigo-600">
                <rect width="18" height="11" x="3" y="11" rx="2" ry="2"/>
                <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
            </svg>
        </div>
        <h2 class="text-xl font-semibold text-gray-900">Private Access</h2>
        <p class="text-gray-600 text-sm mt-1">Enter your security code to continue</p>
    </div>

    <form action="{{ route('security.verify') }}" method="POST" id="otp-form">
        @csrf
        <input type="hidden" name="security_code" id="security_code">

        <x-input-label class="text-center mb-2">Enter Access Code</x-input-label>

        <div class="flex justify-center gap-3 mb-4">
            <input type="text"
                   class="otp-input w-14 h-14 text-center text-2xl font-semibold border-2 rounded-lg focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 @error('security_code') border-red-500 @else border-gray-300 @enderror"
                   maxlength="1"
                   inputmode="numeric"
                   pattern="[0-9]"
                   autocomplete="off"
                   autofocus
                   data-index="0">
            <input type="text"
                   class="otp-input w-14 h-14 text-center text-2xl font-semibold border-2 rounded-lg focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 @error('security_code') border-red-500 @else border-gray-300 @enderror"
                   maxlength="1"
                   inputmode="numeric"
                   pattern="[0-9]"
                   autocomplete="off"
                   data-index="1">
            <input type="text"
                   class="otp-input w-14 h-14 text-center text-2xl font-semibold border-2 rounded-lg focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 @error('security_code') border-red-500 @else border-gray-300 @enderror"
                   maxlength="1"
                   inputmode="numeric"
                   pattern="[0-9]"
                   autocomplete="off"
                   data-index="2">
            <input type="text"
                   class="otp-input w-14 h-14 text-center text-2xl font-semibold border-2 rounded-lg focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 @error('security_code') border-red-500 @else border-gray-300 @enderror"
                   maxlength="1"
                   inputmode="numeric"
                   pattern="[0-9]"
                   autocomplete="off"
                   data-index="3">
        </div>

        <div id="otp-error" class="text-center hidden mb-4">
            <span class="text-sm text-red-600">Please enter all 4 digits</span>
        </div>

        @error('security_code')
            <div class="text-center mb-4">
                <span class="text-sm text-red-600">{{ $message }}</span>
            </div>
        @enderror

        <x-primary-button class="w-full justify-center" id="submit-btn">
            Continue
        </x-primary-button>
    </form>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const inputs = document.querySelectorAll('.otp-input');
        const form = document.getElementById('otp-form');
        const hiddenInput = document.getElementById('security_code');
        const errorDiv = document.getElementById('otp-error');
        const submitBtn = document.getElementById('submit-btn');

        inputs.forEach((input, index) => {
            // Handle input
            input.addEventListener('input', function(e) {
                // Only allow numbers
                this.value = this.value.replace(/[^0-9]/g, '');

                if (this.value.length === 1 && index < inputs.length - 1) {
                    inputs[index + 1].focus();
                }

                updateHiddenInput();
                // Hide error when user starts typing
                errorDiv.classList.add('hidden');
            });

            // Handle backspace
            input.addEventListener('keydown', function(e) {
                if (e.key === 'Backspace' && this.value === '' && index > 0) {
                    inputs[index - 1].focus();
                }
            });

            // Handle paste
            input.addEventListener('paste', function(e) {
                e.preventDefault();
                const pastedData = e.clipboardData.getData('text').replace(/[^0-9]/g, '').slice(0, 4);

                pastedData.split('').forEach((char, i) => {
                    if (inputs[i]) {
                        inputs[i].value = char;
                    }
                });

                const nextIndex = Math.min(pastedData.length, inputs.length - 1);
                inputs[nextIndex].focus();

                updateHiddenInput();
                errorDiv.classList.add('hidden');
            });
        });

        function updateHiddenInput() {
            let code = '';
            inputs.forEach(input => {
                code += input.value;
            });
            hiddenInput.value = code;
        }

        // Update hidden input before form submission
        form.addEventListener('submit', function(e) {
            updateHiddenInput();
            if (hiddenInput.value.length !== 4) {
                e.preventDefault();
                e.stopPropagation();
                errorDiv.classList.remove('hidden');
                inputs[0].focus();
                // Ensure button stays enabled
                submitBtn.disabled = false;
                return false;
            }
        });
    });
    </script>
</x-guest-layout>
