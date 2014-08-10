#Project Management System
##Core Bundle
Core bundle for the PMS System sandbox.

###Entities
- Address
- Carousel
- CarouselItem

###Forms
- AddressFormType
- CarouselFormType
- CarouselItemFormType

###Routes
route name | path
--- | ---
pms_address_edit | /addresses/{slug}/edit
pms_address_index | /addresses
pms_address_new | /addresses/new
pms_address_remove | /addresses/{slug}/remove
pms_address_show | /addresses/{slug}

###Repositories
- AddressRepository
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
