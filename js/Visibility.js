$(window).scroll(function(e) {
    var ProjectElement = document.getElementsByClassName("Project");
    for (var i = 0; i < ProjectElement.length; i++) {
        if (IsVisible(ProjectElement[i])) {
            ProjectElement[i].classList.remove("NotVisible");
            ProjectElement[i].classList.add("IsVisible");
        }
    }
});

function IsVisible(element) {
    var WindowHeight = $(window).height();
    var VisibleTop = $(window).scrollTop();
    var ElementCoordinates = $(element).offset().top;
    var ElementHeight = $(element).height();
    return (ElementCoordinates < (WindowHeight + VisibleTop)) && (ElementCoordinates > (VisibleTop - ElementHeight));
}