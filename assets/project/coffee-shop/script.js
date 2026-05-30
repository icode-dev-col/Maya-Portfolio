/* ==========================================================
   Robert's Coffee Shop Website - Small UI interactions
   ========================================================== */

document.addEventListener("DOMContentLoaded", function () {
  const qtyInput = document.getElementById("qty");
  const sizeSelect = document.getElementById("size");
  const totalPreview = document.getElementById("totalPreview");

  function getPrice(size) {
    if (size === "Small") return 3;
    if (size === "Medium") return 4;
    if (size === "Large") return 5;
    return 0;
  }

  function updatePreview() {
    if (!qtyInput || !sizeSelect || !totalPreview) return;

    const qty = parseInt(qtyInput.value) || 1;
    const size = sizeSelect.value;
    const price = getPrice(size);
    const total = price * qty;

    if (price > 0) {
      totalPreview.textContent = `Live Total Preview: $${total}`;
    } else {
      totalPreview.textContent = "Live Total Preview: Choose a size first";
    }
  }

  if (qtyInput && sizeSelect && totalPreview) {
    qtyInput.addEventListener("input", updatePreview);
    sizeSelect.addEventListener("change", updatePreview);
    updatePreview();
  }
});