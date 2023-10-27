document.addEventListener("DOMContentLoaded", function () {
    var elements = document.getElementsByClassName("text-limit");
    console.log(elements.length);
    for (var i = 0; i < elements.length; i++) {
        var element = elements[i];
        var content = element.innerText;
        console.log(content.length);
        if (content.length > 50) {
            element.textContent = content.slice(0, 50) + "...";
        }
    }
});
