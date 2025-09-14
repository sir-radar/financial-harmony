@extends('home')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-indigo-500 via-purple-500 to-blue-500 p-6 flex items-center justify-center">
    <div class="w-full max-w-6xl bg-white rounded-2xl shadow-xl overflow-hidden">

        <!-- Header -->
        <div class="bg-slate-800 text-white p-8 text-center">
            <h1 class="text-3xl font-bold">Financial Harmony</h1>
            <p class="mt-2 text-lg">Secure Financial Transactions with MongoDB Queryable Encryption</p>
        </div>

        <!-- Encryption Features -->
        <div class="bg-red-600 text-white p-6">
            <h2 class="text-xl font-semibold flex items-center mb-4">
                <span class="mr-2">🔒</span> Encryption Features
            </h2>
            <ul class="space-y-2">
                <li class="flex items-center"><span class="mr-2">🔒</span> Client-side encryption of sensitive financial data</li>
                <li class="flex items-center"><span class="mr-2">🔒</span> Equality queries on encrypted account numbers and SSNs</li>
                <li class="flex items-center"><span class="mr-2">🔒</span> Range queries on encrypted balance and transaction amounts</li>
                <li class="flex items-center"><span class="mr-2">🔒</span> Secure storage with full data encryption at rest</li>
                <li class="flex items-center"><span class="mr-2">🔒</span> Server never sees decrypted sensitive data</li>
            </ul>
        </div>

        <!-- Forms -->
        <div class="grid md:grid-cols-2 gap-6 p-6">
            <!-- Create Account -->
            <div class="border rounded-lg p-6 shadow bg-gray-50">
                <h3 class="text-xl font-semibold mb-4">Create Account</h3>
                <form class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium">Customer Name</label>
                        <input type="text" value="John Doe" class="w-full mt-1 px-3 py-2 border rounded-lg">
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Account Number (Encrypted)</label>
                        <input type="text" value="1234567890" class="w-full mt-1 px-3 py-2 border rounded-lg">
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Balance (Encrypted Range Query)</label>
                        <input type="number" value="50000" class="w-full mt-1 px-3 py-2 border rounded-lg">
                    </div>
                    <div>
                        <label class="block text-sm font-medium">SSN (Encrypted)</label>
                        <input type="text" value="123-45-6789" class="w-full mt-1 px-3 py-2 border rounded-lg">
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Email</label>
                        <input type="email" value="john.doe@example.com" class="w-full mt-1 px-3 py-2 border rounded-lg">
                    </div>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">Create Account</button>
                </form>
            </div>

            <!-- Create Transaction -->
            <div class="border rounded-lg p-6 shadow bg-gray-50">
                <h3 class="text-xl font-semibold mb-4">Create Transaction</h3>
                <form class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium">Account Number (Encrypted)</label>
                        <input type="text" value="1234567890" class="w-full mt-1 px-3 py-2 border rounded-lg">
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Amount (Encrypted Range Query)</label>
                        <input type="number" value="1500" class="w-full mt-1 px-3 py-2 border rounded-lg">
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
                        <input type="text" value="ATM withdrawal" class="w-full mt-1 px-3 py-2 border rounded-lg">
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Card Number (Encrypted)</label>
                        <input type="text" value="4111111111111111" class="w-full mt-1 px-3 py-2 border rounded-lg">
                    </div>
                    <div>
                        <label class="block text-sm font-medium">CVV (Encrypted)</label>
                        <input type="text" value="123" class="w-full mt-1 px-3 py-2 border rounded-lg">
                    </div>
                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg">Create Transaction</button>
                </form>
            </div>
        </div>

        <!-- Queries -->
        <div class="grid md:grid-cols-2 gap-6 p-6">
            <!-- Query Accounts -->
            <div class="border rounded-lg p-6 shadow bg-gray-50">
                <h3 class="text-xl font-semibold mb-4">Query Accounts</h3>
                <form class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium">Find Account by Number (Encrypted Query)</label>
                        <input type="text" value="1234567890" class="w-full mt-1 px-3 py-2 border rounded-lg">
                        <button type="button" class="mt-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">Find Account</button>
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Find Account by SSN (Encrypted Query)</label>
                        <input type="text" value="123-45-6789" class="w-full mt-1 px-3 py-2 border rounded-lg">
                        <button type="button" class="mt-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">Find Account</button>
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Find Accounts by Balance Range (Encrypted Range Query)</label>
                        <div class="flex gap-2">
                            <input type="number" value="25000" class="w-full px-3 py-2 border rounded-lg">
                            <input type="number" value="75000" class="w-full px-3 py-2 border rounded-lg">
                        </div>
                        <button type="button" class="mt-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">Find Accounts</button>
                    </div>
                    <button type="button" class="mt-4 bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">Get All Accounts</button>
                </form>
            </div>

            <!-- Query Transactions -->
            <div class="border rounded-lg p-6 shadow bg-gray-50">
                <h3 class="text-xl font-semibold mb-4">Query Transactions</h3>
                <form class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium">Find Transactions by Account Number (Encrypted Query)</label>
                        <input type="text" value="1234567890" class="w-full mt-1 px-3 py-2 border rounded-lg">
                        <button type="button" class="mt-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">Find Transactions</button>
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Find Transactions by Amount Range (Encrypted Range Query)</label>
                        <div class="flex gap-2">
                            <input type="number" value="500" class="w-full px-3 py-2 border rounded-lg">
                            <input type="number" value="2000" class="w-full px-3 py-2 border rounded-lg">
                        </div>
                        <button type="button" class="mt-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">Find Transactions</button>
                    </div>
                    <button type="button" class="mt-4 bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">Get All Transactions</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
