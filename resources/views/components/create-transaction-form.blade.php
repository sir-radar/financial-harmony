<div class="border rounded-lg p-6 shadow bg-gray-50">
    <h3 class="text-xl font-semibold mb-4">Create Transaction</h3>
    <form class="space-y-4">
        <div>
            <label class="block text-sm font-medium"
                >Account Number (Encrypted)</label
            >
            <input
                type="text"
                value="1234567890"
                class="w-full mt-1 px-3 py-2 border rounded-lg"
            />
        </div>
        <div>
            <label class="block text-sm font-medium"
                >Amount (Encrypted Range Query)</label
            >
            <input
                type="number"
                value="1500"
                class="w-full mt-1 px-3 py-2 border rounded-lg"
            />
        </div>
        <div>
            <label class="block text-sm font-medium">Transaction Type</label>
            <select class="w-full mt-1 px-3 py-2 border rounded-lg">
                <option>Withdrawal</option>
                <option>Deposit</option>
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium">Description</label>
            <input
                type="text"
                value="ATM withdrawal"
                class="w-full mt-1 px-3 py-2 border rounded-lg"
            />
        </div>
        <div>
            <label class="block text-sm font-medium"
                >Card Number (Encrypted)</label
            >
            <input
                type="text"
                value="4111111111111111"
                class="w-full mt-1 px-3 py-2 border rounded-lg"
            />
        </div>
        <div>
            <label class="block text-sm font-medium">CVV (Encrypted)</label>
            <input
                type="text"
                value="123"
                class="w-full mt-1 px-3 py-2 border rounded-lg"
            />
        </div>
        <button
            type="submit"
            class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg"
        >
            Create Transaction
        </button>
    </form>
</div>
