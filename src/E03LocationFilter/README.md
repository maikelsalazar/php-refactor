# E03 – Location Filter

This exercise introduces string parsing and filtering logic refactoring. The code filters a list of locations based on a textual condition like "country:MX" or "city:CDMX".

---

## 🧩 Original Implementation

The original LocationFilter class contains hardcoded conditions for specific filters:

```php
if ($filter === 'country:MX' && $loc['country'] === 'MX') { ... }
elseif ($filter === 'city:CDMX' && $loc['city'] === 'CDMX') { ... }
```

This makes the code rigid and non-extensible.
To support new filters (e.g. "country:US" or "city:Monterrey"), the developer must add more if statements manually.

---

## 🧠 Refactoring Goals

Refactor the code to make it flexible, extensible, and maintainable by:

- Parsing the filter string dynamically, rather than hardcoding values.
- Supporting multiple key-value pairs, e.g. "country:MX;city:CDMX".
- Removing duplicated conditional logic inside the loop.
- Ensuring case-insensitive comparisons.
- Keeping the design clean, testable, and easy to extend.

---

## 🎯 Objectives

- Apply Single Responsibility and Open/Closed principles.
- Separate filter parsing from location matching.
- Avoid hardcoded comparisons.
- Make it possible to add new filter keys without modifying core logic.
- Keep unit tests readable and reusable via data providers.

---

## ✅ Expected Outcome

After refactoring:

- The filter logic dynamically adapts to any valid key:value pair.
- It supports complex filters like "country:US;city:New York".
- The solution remains covered by a single, shared data provider for testing.
- The resulting design is clean, generic, and easy to extend for future filter types.
