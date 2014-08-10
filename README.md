#Project Management System
##Core Bundle
Core bundle for the PMS System sandbox.

###Entities
- Carousel
- CarouselItem

###Forms
- CarouselFormType
- CarouselItemFormType

###Routes
route name | path
--- | ---
pms_carousel_edit | /carousels/{slug}/edit
pms_carousel_index | /carousels
pms_carousel_new | /carousels/new
pms_carousel_remove | /carousels/{slug}/remove
pms_carousel_show | /carousels/{slug}

###Repositories
- CarouselRepository
- CarouselItemRepository

###Resources
Action | Template
--- | ---
edit | edit.html.twig
index | index.html.twig
new | new.html.twig
remove | remove.html.twig
show | show.html.twig
