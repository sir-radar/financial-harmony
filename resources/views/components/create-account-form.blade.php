<div
    x-data="{ name: '',
    account_number: '',
    balance: '',
    email: '',
    ssn: '',
    async submitForm() {
        try {
            const response = await fetch('/api/accounts', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    name: this.name,
                    email: this.email,
                    balance: this.balance,
                    ssn: this.ssn,
                    account_number: this.account_number
                })
            });

            if (!response.ok) {
                // Try to parse JSON error details
                let errorData;
                try {
                    errorData = await response.json();
                } catch {
                    errorData = { message: await response.text() };
                }

                throw errorData;
            }

            const data = await response.json();

            $refs.code.style.background = '#DCFCE7';
            $refs.code.style.color = '#166534';
            $refs.code.textContent = JSON.stringify(data, null, 2);
        } catch (error) {
            let message = 'Unexpected error occurred';

            let validationMessages = [];

            if (error.errors) {
                // Flatten validation errors into a single array
                validationMessages = Object.values(error.errors).flat();
            }
            $refs.code.style.background = '#FEE2E2';
            $refs.code.style.color = 'red';
            $refs.code.textContent = JSON.stringify(
                {
                    error: true,
                    message,
                    validation: validationMessages.length ? validationMessages : undefined
                },
                null,
                2
            );
        }
    }

}"
    class="border rounded-lg p-6 shadow bg-gray-50"
>
    <h3 class="text-xl font-semibold mb-4">Create Account</h3>
    <form @submit.prevent="submitForm" class="space-y-4">
        <div>
            <label class="block text-sm font-medium">Customer Name</label>
            <input
                type="text"
                name="name"
                class="w-full mt-1 px-3 py-2 border rounded-lg"
                x-model="name"
            />
        </div>
        <div>
            <label class="block text-sm font-medium"
                >Account Number (Encrypted)</label
            >
            <input
                type="number"
                x-model="account_number"
                name="account_number"
                class="w-full mt-1 px-3 py-2 border rounded-lg"
            />
        </div>
        <div>
            <label class="block text-sm font-medium"
                >Balance (Encrypted Range Query)</label
            >
            <input
                type="number"
                x-model="balance"
                name="balance"
                class="w-full mt-1 px-3 py-2 border rounded-lg"
            />
        </div>
        <div>
            <label class="block text-sm font-medium">SSN (Encrypted)</label>
            <input
                type="number"
                x-model="ssn"
                name="ssn"
                class="w-full mt-1 px-3 py-2 border rounded-lg"
            />
        </div>
        <div>
            <label class="block text-sm font-medium">Email</label>
            <input
                type="email"
                x-model="email"
                name="email"
                class="w-full mt-1 px-3 py-2 border rounded-lg"
            />
        </div>
        <button
            type="submit"
            class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg cursor-pointer"
        >
            Create Account
        </button>
    </form>

    <pre x-ref="code" style="padding: 1rem; margin-top: 1rem"></pre>
</div>
