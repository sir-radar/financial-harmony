<div class="border rounded-lg p-6 shadow bg-gray-50">
    <h3 class="text-xl font-semibold mb-4">Query Transactions</h3>
    <form class="space-y-4">
        <div>
            <label class="block text-sm font-medium"
                >Find Transactions by Account Number (Encrypted Query)</label
            >
            <input
                type="text"
                value="1234567890"
                class="w-full mt-1 px-3 py-2 border rounded-lg"
            />
            <button
                type="button"
                class="mt-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg"
            >
                Find Transactions
            </button>
        </div>
        <div>
            <label class="block text-sm font-medium"
                >Find Transactions by Amount Range (Encrypted Range
                Query)</label
            >
            <div class="flex gap-2">
                <input
                    type="number"
                    value="500"
                    class="w-full px-3 py-2 border rounded-lg"
                />
                <input
                    type="number"
                    value="2000"
                    class="w-full px-3 py-2 border rounded-lg"
                />
            </div>
            <button
                type="button"
                class="mt-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg"
            >
                Find Transactions
            </button>
        </div>
        <button
            type="button"
            class="mt-4 bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg"
        >
            Get All Transactions
        </button>
    </form>
</div>
