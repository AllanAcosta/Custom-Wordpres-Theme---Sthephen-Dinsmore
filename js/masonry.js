// let el = document.querySelectorAll(".item_custom_grid");
// console.log(el);

// function resizeGridItem(item) {
//   grid = document.getElementsByClassName("custom_grid")[0];
//   rowHeight = parseInt(window.getComputedStyle(grid).getPropertyValue('grid-auto-rows'));
//   rowGap = parseInt(window.getComputedStyle(grid).getPropertyValue('grid-row-gap'));
//   rowSpan = Math.ceil((item.querySelector('.custom_content').getBoundingClientRect().height + rowGap) / (rowHeight +
//       rowGap));
//   item.style.gridRowEnd = "span " + rowSpan;
// }

// function resizeAllGridItems() {
//   allItems = document.getElementsByClassName("item_custom_grid");
//   for (x = 0; x < allItems.length; x++) {
//       if (window.CP.shouldStopExecution(0)) break;
//       resizeGridItem(allItems[x]);
//   }
//   window.CP.exitedLoop(0);
// }

// function resizeInstance(instance) {
//   item = instance.elements[0];
//   resizeGridItem(item);
// }

// window.onload = resizeAllGridItems();
// window.addEventListener("resize", resizeAllGridItems);

// allItems = document.getElementsByClassName("item_custom_grid");
// for (x = 0; x < allItems.length; x++) {
//   if (window.CP.shouldStopExecution(1)) break;
//   imagesLoaded(allItems[x], resizeInstance);
// }
// window.CP.exitedLoop(1);
// //# sourceURL=pen.js

