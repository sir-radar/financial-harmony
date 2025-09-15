<div
    x-data="{
    account_number: '',
    ssn: '',
    min: '',
    max: '',
    findByAccountNumber() {
        if(this.account_number.trim().length < 1) return
        $store.api.submitForm(
                    `accounts/number/${this.account_number}`,
                    {},
                    $refs,
                    'byAccount',
                    'GET')
    },
    findBySSN() {
        if(this.ssn.trim().length < 1) return
        $store.api.submitForm(
                    `accounts/ssn/${this.ssn}`,
                    {},
                    $refs,
                    'bySSN',
                    'GET')
    },
    findByRange() {
        if(this.min.trim().length < 1 && this.max.trim().length < 1) return
        $store.api.submitForm(
                    `accounts/balance/${this.min}/${this.max}`,
                    {},
                    $refs,
                    'byRange',
                    'GET')
    }
}"
    class="border rounded-lg p-6 shadow bg-gray-50"
>
    <h3 class="text-xl font-semibold mb-4">Query Accounts</h3>
    <form class="space-y-4">
        <div>
            <label class="block text-sm font-medium"
                >Find Account by Number (Encrypted Query)</label
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
                @click="findByAccountNumber"
            >
                Find Account
            </button>
            <pre x-ref="byAccount"></pre>
        </div>
        <div>
            <label class="block text-sm font-medium"
                >Find Account by SSN (Encrypted Query)</label
            >
            <input
                type="number"
                x-model="ssn"
                class="w-full mt-1 px-3 py-2 border rounded-lg"
            />
            <button
                type="button"
                class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 mt-2 rounded-lg cursor-pointer"
                @click="findBySSN"
            >
                Find Account
            </button>
            <pre x-ref="bySSN"></pre>
        </div>
        <div>
            <label class="block text-sm font-medium"
                >Find Accounts by Balance Range (Encrypted Range Query)</label
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
                @click="findByRange"
            >
                Find Accounts
            </button>
            <pre x-ref="byRange"></pre>
        </div>
    </form>
</div>
