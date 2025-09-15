<div
    x-data="{
    account_number: '',
    min: '',
    max: '',
    findTransactionByAccountNumber() {
        if(this.account_number.trim().length < 1) return
        $store.api.submitForm(
                    `transactions/account/${this.account_number}`,
                    {},
                    $refs,
                    'trancbyAccount',
                    'GET')
    },
    findTransactionByRange() {
        if(this.min.trim().length < 1 && this.max.trim().length < 1) return
        $store.api.submitForm(
                    `transaction/amount/${this.min}/${this.max}`,
                    {},
                    $refs,
                    'transcbyRange',
                    'GET')
    }
}"
    class="border rounded-lg p-6 shadow bg-gray-50"
>
    <h3 class="text-xl font-semibold mb-4">Query Transactions</h3>
    <form class="space-y-4">
        <div>
            <label class="block text-sm font-medium"
                >Find Transactions by Account Number (Encrypted Query)</label
            >
            <input
                type="number"
                required
                x-model="account_number"
                :oninput="account_number.length > $store.api.ACCOUNT_NUMBER_LENGTH ? account_number = account_number.slice(0, $store.api.ACCOUNT_NUMBER_LENGTH) : account_number"
                name="account_number"
                class="w-full mt-1 px-3 py-2 border rounded-lg"
            />
            <button
                type="button"
                class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 mt-2 rounded-lg cursor-pointer"
                @click="findTransactionByAccountNumber"
            >
                Find Transactions
            </button>
            <pre x-ref="trancbyAccount"></pre>
        </div>
        <div>
            <label class="block text-sm font-medium"
                >Find Transactions by Amount Range (Encrypted Range
                Query)</label
            >
            <div class="flex gap-2">
                <input
                    type="number"
                    x-model="min"
                    name="min"
                    placeholder="Min"
                    class="w-full px-3 py-2 border rounded-lg"
                />
                <input
                    type="number"
                    x-model="max"
                    name="max"
                    placeholder="Max"
                    class="w-full px-3 py-2 border rounded-lg"
                />
            </div>
            <button
                type="button"
                class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 mt-2 rounded-lg cursor-pointer"
                @click="findTransactionByRange"
            >
                Find Transactions
            </button>
            <pre x-ref="transcbyRange"></pre>
        </div>
    </form>
</div>
