function highlightIcon(element, boldIcon) {
  element.querySelector("img").src = boldIcon;
}

function unHighlightIcon(element, originalIcon) {
  element.querySelector("img").src = originalIcon;
}
