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
            @include('components.create-account-form')

            <!-- Create Transaction -->
            @include('components.create-transaction-form')
          
        </div>

        <!-- Queries -->
        <div class="grid md:grid-cols-2 gap-6 p-6">
            <!-- Query Accounts -->
             @include('components.query-account-form')

            <!-- Query Transactions -->
            @include('components.query-transaction-form')
        </div>
    </div>
</div>
@endsection
