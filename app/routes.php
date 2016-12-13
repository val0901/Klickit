<?php
	
	$w_routes = array(
		['GET', '/', 'Default#home', 'default_home'],

		//Routes pour le front (classé par controller)
		['GET|POST', '/front/index', 'Front#index', 'front_index'],
		['GET|POST', '/front/login', 'Front#login', 'front_login'],

		//Pages liées à UserController
		['GET|POST', '/front/addUser', 'User#faddUser', 'front_faddUser'],
		['GET|POST', '/front/cptUser', 'User#affCptUser', 'front_affcptuser'],
		['GET|POST', '/front/UpdateUser', 'User#fupdateUser', 'front_fupdateUser'],


		//Routes pour le back (classé par controller)
		['GET|POST', '/back/index', 'Back#index', 'back_index'],
		['GET|POST', '/back/login', 'Back#login', 'back_login'],

		// Les routes ajax
		['GET|POST', '/ajax/logout', 'Ajax#logout', 'ajax_logout'],
		['GET|POST', '/ajax/deleteUser/[i:id]', 'Ajax#deleteUser', 'ajax_deleteUser'],

		//Pages liées à UserController
		['GET|POST', '/back/listUser', 'User#listUser', 'listUser'],
		['GET|POST', '/back/addUser', 'User#addUser', 'addUser'],
		['GET|POST', '/back/deleteUser/[i:id]', 'User#deleteUser', 'deleteUser'],
		['GET|POST', '/back/updateUser/[i:id]', 'User#updateUser', 'updateUser'],


		//Pages liées à MessageController
		['GET|POST', '/back/listMessage', 'Message#listMessage', 'listMessage'],
		['GET|POST', '/back/viewMessage/[i:id]', 'Message#viewMessage', 'viewMessage'],
		['GET|POST', '/back/deleteMessage/[i:id]', 'Message#deleteMessage', 'deleteMessage'],

		//Pages liées à EventController
		['GET|POST', '/back/listEvent', 'Event#listEvent', 'listEvent'],
		['GET|POST', '/back/addEvent', 'Event#addEvent', 'addEvent'],
		['GET|POST', '/back/updateEvent/[i:id]', 'Event#updateEvent', 'updateEvent'],
		['GET|POST', '/back/deleteEvent/[i:id]', 'Event#deleteEvent', 'deleteEvent'],

		//Pages liées à SlideController
		['GET|POST', '/back/listSlide', 'Slide#listSlide', 'listSlide'],
		['GET|POST', '/back/addSlide', 'Slide#addSlide', 'addSlide'],
		['GET|POST', '/back/deleteSlide/[i:id]', 'Slide#deleteSlide', 'deleteSlide'],
		['GET|POST', '/back/updateSlide/[i:id]', 'Slide#updateSlide', 'updateSlide'],

		//Pages liées à ItemController
		['GET|POST', '/back/listItem', 'Item#listItem', 'listItem'],
		['GET|POST', '/back/addItem', 'Item#addItem', 'addItem'],
		['GET|POST', '/back/deleteItem/[i:id]', 'Item#deleteItem', 'deleteItem'],
		['GET|POST', '/back/updateItem/[i:id]', 'Item#updateItem', 'updateItem'],
		['GET|POST', '/front/listItemClassics', 'Item#listItemClassics', 'listItemClassics'],
		['GET|POST', '/front/listItemCustoms', 'Item#listItemCustoms', 'listItemCustoms'],
		['GET|POST', '/front/listItemDivers', 'Item#listItemDivers', 'listItemDivers'],
		['GET|POST', '/front/listItemPieces', 'Item#listItemPieces', 'listItemPieces'],

		//Pages liées à OrdersController
		['GET|POST', '/back/listOrders', 'Orders#listOrders', 'listOrders'],
		['GET|POST', '/back/viewOrder/[i:id]', 'Orders#viewOrders', 'viewOrders'],
		['GET|POST', '/front/listUserOrders', 'Orders#listUserOrders', 'front_listOrders'],
		['GET|POST', '/front/viewUserCde', 'Orders#viewUserOrders', 'front_viewUserCde'],


		//Pages liées à ShippingController
		['GET|POST', '/back/listShipping', 'Shipping#listShipping', 'listShipping'],
		['GET|POST', '/back/addShipping', 'Shipping#addShipping', 'addShipping'],
		['GET|POST', '/back/deleteShipping/[i:id]', 'Shipping#deleteShipping', 'deleteShipping'],

		//Pages liées à GuestbookController
		['GET|POST', '/back/listGuestbook', 'Guestbook#listGuestbook', 'listGuestbook'],
		['GET|POST', '/back/moderation', 'Guestbook#moderation', 'moderation'],
		['GET|POST', '/front/guestBook', 'Guestbook#affGuestbook', 'front_guestBook'],

	);