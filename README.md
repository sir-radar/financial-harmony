# Financial Harmony

This Laravel application demonstrates **field-level encryption with searchable indexes** for sensitive data stored in a MySQL database.  

This idea was taken from this [video](https://www.youtube.com/watch?v=UuknxVdqzb4&ab_channel=freeCodeCamp.org) on freeCodeCamp.org youtube channel.

It replicates the idea of **MongoDB Client-Side Field-Level Encryption**:  

- Data is **encrypted before reaching the database**.  
- The database never sees plaintext or keys.  
- Special **blind indexes** allow equality queries (find by Account Number, SSN, Amount, etc.) without decrypting data on the server.  
- Encryptions were done using [ciphersweet](https://github.com/paragonie/ciphersweet).
For more in depth knowledge [see](https://ciphersweet.paragonie.com/)

---

## 🔐 Features

- **Account Management**
  - Create an account (name, email, account number, balance, SSN).
  - Find account by **Account Number** (encrypted search).
  - Find account by **SSN** (encrypted search).
  - Find accounts by **Balance range** (bucketed/blind index search).

- **Transaction Management**
  - Create transaction (amount, type, description, card number, CVV).
  - Find transactions by **Account Number**.
  - Find transactions by **Amount range**.

- **Encryption**
  - Account fields encrypted: `account_number`, `balance`, `ssn`.
  - Transaction fields encrypted: `amount`, `card_number`, `cvv`.
  - Queries use **blind indexes** (deterministic HMAC tokens).
  - Only Laravel decrypts data; MySQL stores ciphertext only.

---

## ⚙️ Requirements

- PHP 8.1+  
- Laravel 10+  
- Docker  
- Composer  
- Ciphersweet 
- AlpineJS

---

## 📦 Installation

1. **Clone repo & install dependencies**

```bash
git clone https://github.com/sir-radar/finacial-harmony
cd finacial-harmony
composer install
npm install
```

2. **Environment setup**

Copy `.env.example` to `.env` and configure database:

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=8001
DB_DATABASE=encrypted_finance
DB_USERNAME=finance
DB_PASSWORD=encrypted
```

Add encryption keys (generate a random 32-byte key):

```bash
APP_KEY=base64:xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
CIPHERSWEET_KEY=base64:yyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyy
```

Use openssl in your terminal

```bash
 openssl rand -base64 32
```

Or

> ⚠️ Use a secure random key from `php artisan tinker`:
> ```php
> base64_encode(random_bytes(32));
> ```

3. **Start Docker**

```bash
docker compose up -d
```

4. **Run migrations**

```bash
php artisan migrate
```

5. **Start App**

```bash
php artisan serve
npm run dev
```

---

## 🔐 How Encryption Works

This app uses [ParagonIE CipherSweet](https://ciphersweet.paragonie.com/) under the hood.

- **Ciphertext Columns**: Sensitive values are encrypted before saving (`account_number`, `balance`, `ssn`, etc.).
- **Blind Index Columns**: For searchable fields, a deterministic HMAC-based index is stored alongside ciphertext.
  - Example: searching for SSN `"123-45-6789"` → Laravel computes the blind index → MySQL matches `ssn_index`.
  - Database never sees the plaintext or encryption key.
- **Range Queries**: True range queries are not possible with blind indexes.
  - Workaround: **bucketization** (e.g., store `balance_bucket = floor(balance/100)`) for efficient range lookups.

---

## 🗄️ Database Schema

### `accounts` table

| Column                | Type    | Notes                             |
|------------------------|---------|----------------------------------|
| `id`                  | BIGINT  | Primary key                      |
| `name`                | VARCHAR | Plaintext                        |
| `email`               | VARCHAR | Unique, plaintext                |
| `account_number`      | BLOB    | Encrypted                        |
| `account_number_index`| VARCHAR | Blind index (searchable)         |
| `balance`             | BLOB    | Encrypted                        |
| `balance_index`       | VARCHAR | Blind index (for equality/bucket)|
| `ssn`                 | BLOB    | Encrypted                        |
| `ssn_index`           | VARCHAR | Blind index                      |
| `timestamps`          | ...     | Created/Updated                   |

### `transactions` table

| Column                | Type    | Notes                             |
|------------------------|---------|----------------------------------|
| `id`                  | BIGINT  | Primary key                      |
| `account_id`          | BIGINT  | Foreign key → accounts.id        |
| `amount`              | BLOB    | Encrypted                        |
| `amount_index`        | VARCHAR | Blind index                      |
| `card_number`         | BLOB    | Encrypted                        |
| `card_number_index`   | VARCHAR | Blind index                      |
| `cvv`                 | BLOB    | Encrypted                        |
| `type`                | ENUM    | withdrawal / deposit             |
| `description`         | TEXT    | Optional, plaintext              |
| `timestamps`          | ...     | Created/Updated                   |

---

## 📖 API Usage

### Create Account
```http
POST /accounts
Content-Type: application/json

{
  "name": "Alice",
  "email": "alice@example.com",
  "account_number": "123456789012",
  "balance": 5000.50,
  "ssn": "123-45-6789"
}
```

### Find Account by Number
```http
GET /accounts/number/123456789012
```

### Find Account by SSN
```http
GET /accounts/ssn/123-45-6789
```

### Find Accounts by Balance Range
```http
GET /accounts/balance/1000/5000
```

---

### Create Transaction
```http
POST /transactions
Content-Type: application/json

{
  "account_id": 1,
  "amount": 200.00,
  "type": "deposit",
  "description": "Paycheck",
  "card_number": "4111111111111111",
  "cvv": "123"
}
```

### Find Transactions by Account Number
```http
GET /transactions/account/123456789012
```

### Find Transactions by Amount Range
```http
GET /transactions/amount/100/500
```

---

## ⚠️ Security Considerations

- **Range queries**: true range queries over encrypted data are not possible without advanced cryptography (OPE/FHE). Used bucketization instead.  
- **Key management**:  
  - Do **not** hardcode keys in code.  
  - Store in `.env` or use AWS KMS / HashiCorp Vault.  
  - Rotate keys periodically.   

---

## 🧪 Development Notes

- Models handle encryption/decryption automatically via accessors/mutators.  
- Query helpers (`findByAccountNumber`, `findBySsn`, etc.) use blind indexes.  
- Controllers expose JSON APIs for creating and searching accounts/transactions.  

---

## 🛡️ Future Improvements
- Add **prefix blind indexes** for partial search (e.g., SSN prefix).  
- Integrate with **Vault/KMS** for secure key management.  
- Add **unit tests** for encryption/decryption and search.  

---

## 📜 License

MIT License. Use at your own risk — **encryption in production systems requires careful key management and threat modeling.**
