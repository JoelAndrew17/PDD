const form = document.querySelector("form"),
      nextBtn = form.querySelector(".nextBtn"),
      backBtn = form.querySelector(".backBtn"),
      allInput = form.querySelectorAll(".first input");

nextBtn.addEventListener("click", () => {
    const allFilled = Array.from(allInput).every(input => input.value.trim() !== "");
    
    if (allFilled) {
        form.classList.add('secActive');
    } else {
        alert("Please fill all required fields.");
    }
});

backBtn.addEventListener("click", () => form.classList.remove('secActive'));
