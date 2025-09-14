<div class="border rounded-lg p-6 shadow bg-gray-50">
    <h3 class="text-xl font-semibold mb-4">Create Account</h3>
    <form class="space-y-4">
        <div>
            <label class="block text-sm font-medium">Customer Name</label>
            <input
                type="text"
                value="John Doe"
                class="w-full mt-1 px-3 py-2 border rounded-lg"
            />
        </div>
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
                >Balance (Encrypted Range Query)</label
            >
            <input
                type="number"
                value="50000"
                class="w-full mt-1 px-3 py-2 border rounded-lg"
            />
        </div>
        <div>
            <label class="block text-sm font-medium">SSN (Encrypted)</label>
            <input
                type="text"
                value="123-45-6789"
                class="w-full mt-1 px-3 py-2 border rounded-lg"
            />
        </div>
        <div>
            <label class="block text-sm font-medium">Email</label>
            <input
                type="email"
                value="john.doe@example.com"
                class="w-full mt-1 px-3 py-2 border rounded-lg"
            />
        </div>
        <button
            type="submit"
            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg"
        >
            Create Account
        </button>
    </form>
</div>
