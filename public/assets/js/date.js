var today = new Date().toISOString().split("T")[0];
document.getElementById("from-date").setAttribute("max", today);
document.getElementById("to-date").setAttribute("min", today);
