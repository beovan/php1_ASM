window.onload = function() {
  const canvas = document.getElementById("myCanvas");
  const ctx = canvas.getContext("2d");
  const img = document.getElementById("cat-picture");
  ctx.drawImage(img, 2, 2);
};