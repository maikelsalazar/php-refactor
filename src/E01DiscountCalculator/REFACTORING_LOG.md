# E01 – Discount Calculator: Refactoring Log

## 🪜 Iteration Summary

### 1. Initial Setup
- Added the original implementation under `Solution/DiscountCalculator.php` as the baseline for refactoring.
- Wrote initial tests to capture the legacy behavior and ensure no regressions during refactoring.

### 2. Domain Modeling
- Introduced `Order` and `User` domain models.
- Defined `DiscountRule` interface.
- Implemented rule classes:
  - `PremiumUserDiscountRule`
  - `RegularUserDiscountRule`
  - `GuestUserDiscountRule`

### 3. Refactoring and Service Layer
- Added `DiscountService` to orchestrate rule evaluation.
- Simplified `DiscountCalculator` to act as a facade.
- Ensured the first matching rule determines the discount.

### 4. Unit Testing and Consistency
- Added comprehensive tests for each rule and domain model.
- Standardized test naming conventions (`testBuildsX`, `testCalculatesX`).
- Improved test readability and organization.

---

## ⚙️ Design Decisions

- One active rule per order (first match wins).
- Avoided inheritance to keep rule classes independent.
- Chose explicit rule registration for transparency over dynamic discovery.
- Defaulted all monetary fields to `float` for simplicity.

---

## ⚠️ Known Limitations / Future Improvements

- No **stacking or combination** of multiple discounts.
- No **configurable rule priority** beyond array order.
- No **currency or rounding** logic (assumes base currency).
- Future enhancement: support **percentage configuration** or **external rule registration**.
- **Input validation** (e.g., negative amounts) intentionally simplified for clarity.

---

## ✅ Lessons Learned

- Extracting domain logic into small, cohesive classes improves testability.
- Consistent test naming greatly improves readability and maintenance.
- Refactoring legacy conditionals into explicit rules is a powerful way to reveal business intent.
- Keeping a changelog for each exercise adds transparency to the refactoring journey.
