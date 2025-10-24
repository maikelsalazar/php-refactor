# E02 – Invoice Generator

This exercise focuses on **extracting responsibilities** and **improving testability** by decoupling side effects (like file writing) from business logic.

---

## 🧩 Original Implementation

The original `InvoiceGenerator` class mixes:
- **Computation logic** (subtotal, tax, total)
- **Text formatting**
- **File I/O** (writing `invoice.txt`)

This makes testing and extension harder, since generating an invoice always writes a file to disk.

---

## 🧠 Refactoring Goals

Refactor the code to:
1. Separate **core logic** (invoice text generation) from **persistence**.
2. Introduce **interfaces** for better testability, e.g. `Storage` or `TaxCalculator`.
3. Remove hardcoded dependencies (like `file_put_contents`).
4. Make it possible to **unit test without touching the filesystem**.

---

## ✅ Expected Outcome

After refactoring:
- You can generate invoice text without side effects.
- The file writing is handled by an injected `Storage` implementation.
- The solution becomes easier to extend (e.g., for different tax rules or formats).
