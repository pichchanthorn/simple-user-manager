document.addEventListener("DOMContentLoaded", () => {

  setCurrentYear();
  applySavedTheme();
  initFeatherIcons();

});

function setCurrentYear(){
  const el = document.getElementById("year");
  if(el) el.textContent = new Date().getFullYear();
}

function initFeatherIcons(){
  if(window.feather) feather.replace();
}

function toggleTheme(){
  const isLight = document.body.classList.toggle("light");
  localStorage.setItem("theme", isLight ? "light" : "dark");
  updateThemeIcon(isLight);
  initFeatherIcons();
}

function applySavedTheme(){
  const theme = localStorage.getItem("theme");
  if(theme === "light"){
    document.body.classList.add("light");
    updateThemeIcon(true);
  }
}

function updateThemeIcon(isLight){
  const icon = document.querySelector(".theme-toggle i");
  if(!icon) return;
  icon.setAttribute("data-feather", isLight ? "sun" : "moon");
}
