<div
    x-data="{
    name: '',
    account_number: '',
    balance: '',
    email: '',
    ssn: '',
    submit() {
        $store.api.submitForm(
                    'accounts',
                    {
                        name: this.name,
                        email: this.email,
                        balance: this.balance,
                        ssn: this.ssn,
                        account_number: this.account_number
                    },
                    $refs,
                    'code',
                    'POST')
    }
}"
    class="border rounded-lg p-6 shadow bg-gray-50"
>
    <h3 class="text-xl font-semibold mb-4">Create Account</h3>
    <form @submit.prevent="submit" class="space-y-4">
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
                :oninput="account_number.length > $store.api.ACCOUNT_NUMBER_LENGTH ? account_number = account_number.slice(0, $store.api.ACCOUNT_NUMBER_LENGTH) : account_number"
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

    <pre x-ref="code"></pre>
</div>
