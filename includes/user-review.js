function userReview() {
 
  console.log('userReview()')

}


window.addEventListener("DOMContentLoaded", (event) => {
  jQuery(window).on("elementor/frontend/init", () => {

    const userReviewHandler = ($element) => {
      elementorFrontend.elementsHandler.addHandler(userReview, {
        $element,
      });
    };
    elementorFrontend.hooks.addAction(
      "frontend/element_ready/user-review.default",
      userReviewHandler
    );

  })
})