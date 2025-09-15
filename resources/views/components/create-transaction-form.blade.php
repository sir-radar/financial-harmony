<div
    x-data="{
    account_number: '',
    amount: '',
    type: '',
    description: '',
    card_number: '',
    cvv: '',
    submit() {
        $store.api.submitForm(
                    'transactions',
                    {
                        type: this.type.toLowerCase(),
                        description: this.description,
                        amount: this.amount,
                        card_number: this.card_number,
                        cvv: this.cvv,
                        account_number: this.account_number
                    },
                    $refs,
                    'trans',
                    'POST')
    }
    }"
    class="border rounded-lg p-6 shadow bg-gray-50"
>
    <h3 class="text-xl font-semibold mb-4">Create Transaction</h3>
    <form @submit.prevent="submit" class="space-y-4">
        <div>
            <label class="block text-sm font-medium"
                >Account Number (Encrypted)</label
            >
            <input
                type="number"
                name="account_number"
                x-model="account_number"
                :oninput="account_number.length > $store.api.ACCOUNT_NUMBER_LENGTH ? account_number = account_number.slice(0, $store.api.ACCOUNT_NUMBER_LENGTH) : account_number"
                class="w-full mt-1 px-3 py-2 border rounded-lg"
            />
        </div>
        <div>
            <label class="block text-sm font-medium"
                >Amount (Encrypted Range Query)</label
            >
            <input
                type="number"
                name="amount"
                x-model="amount"
                class="w-full mt-1 px-3 py-2 border rounded-lg"
            />
        </div>
        <div>
            <label class="block text-sm font-medium">Transaction Type</label>
            <select
                x-model="type"
                name="type"
                class="w-full mt-1 px-3 py-2 border rounded-lg"
            >
                <option>Withdrawal</option>
                <option>Deposit</option>
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium">Description</label>
            <input
                type="text"
                name="description"
                x-model="description"
                class="w-full mt-1 px-3 py-2 border rounded-lg"
            />
        </div>
        <div>
            <label class="block text-sm font-medium"
                >Card Number (Encrypted)</label
            >
            <input
                type="number"
                name="card_number"
                x-model="card_number"
                class="w-full mt-1 px-3 py-2 border rounded-lg"
            />
        </div>
        <div>
            <label class="block text-sm font-medium">CVV (Encrypted)</label>
            <input
                type="number"
                name="cvv"
                x-model="cvv"
                :oninput="cvv.length > 3 ? cvv = cvv.slice(0, 3) : cvv"
                class="w-full mt-1 px-3 py-2 border rounded-lg"
            />
        </div>
        <button
            type="submit"
            class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg cursor-pointer"
        >
            Create Transaction
        </button>
    </form>
    <pre x-ref="trans"></pre>
</div>
