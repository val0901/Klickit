<?php
	
	$w_routes = array(
		['GET', '/', 'Default#home', 'default_home'],

/******************** BACK *********************/

		//Routes pour le back (classé par controller)
		['GET|POST', '/admin/home', 'Back#index', 'back_index'],
		['GET|POST', '/admin/login', 'Back#login', 'back_login'],
		['GET|POST', '/admin/forgot_password', 'Back#forgot_pwd', 'back_forgot_pwd'],

		//Pages liées à ResetController
		['GET|POST', '/admin/reset_password/[i:id]/[:token]/', 'Reset#reset_pwd', 'back_reset_pwd'],

		// Les routes ajax
		['GET|POST', '/ajax/logout', 'Ajax#logout', 'ajax_logout'],
		['GET|POST', '/ajax/deleteUser', 'Ajax#deleteUser', 'ajax_deleteUser'],
		['GET|POST', '/ajax/deleteItem', 'Ajax#deleteItem', 'ajax_deleteItem'],
		['GET|POST', '/ajax/deleteMessage', 'Ajax#deleteMessage', 'ajax_deleteMessage'],
		['GET|POST', '/ajax/deleteEvent', 'Ajax#deleteEvent', 'ajax_deleteEvent'],
		['GET|POST', '/ajax/delete/moderation', 'Ajax#deleteMessageMod', 'ajax_delete_message_mod'],
		['GET|POST', '/ajax/deleteSlide', 'Ajax#deleteSlide', 'ajax_deleteSlide'],
		['GET|POST', '/ajax/deleteShipping', 'Ajax#deleteShipping', 'ajax_deleteShipping'],
		['GET|POST', '/ajax/updateOrder', 'Ajax#updateStatus', 'ajax_updateStatus'],

		//Pages liées à UserController
		['GET|POST', '/admin/listUser', 'User#listUser', 'listUser'],
		['GET|POST', '/admin/addUser', 'User#addUser', 'addUser'],
		['GET|POST', '/admin/updateUser/[i:id]', 'User#updateUser', 'updateUser'],


		//Pages liées à MessageController
		['GET|POST', '/admin/listMessage', 'Message#listMessage', 'listMessage'],
		['GET|POST', '/admin/viewMessage/[i:id]', 'Message#viewMessage', 'viewMessage'],

		//Pages liées à EventController
		['GET|POST', '/admin/listEvent', 'Event#listEvent', 'listEvent'],
		['GET|POST', '/admin/addEvent', 'Event#addEvent', 'addEvent'],
		['GET|POST', '/admin/updateEvent/[i:id]', 'Event#updateEvent', 'updateEvent'],

		//Pages liées à SlideController
		['GET|POST', '/admin/listSlide', 'Slide#listSlide', 'listSlide'],
		['GET|POST', '/admin/addSlide', 'Slide#addSlide', 'addSlide'],
		['GET|POST', '/admin/updateSlide/[i:id]', 'Slide#updateSlide', 'updateSlide'],

		//Pages liées à ItemController
		['GET|POST', '/admin/listItem', 'Item#listItem', 'listItem'],
		['GET|POST', '/admin/addItem', 'Item#addItem', 'addItem'],
		['GET|POST', '/admin/updateItem/[i:id]', 'Item#updateItem', 'updateItem'],

		//Pages liées à OrdersController
		['GET|POST', '/admin/listOrders', 'Orders#listOrders', 'listOrders'],
		['GET|POST', '/admin/viewOrder/[i:id]', 'Orders#viewOrders', 'viewOrders'],


		//Pages liées à ShippingController
		['GET|POST', '/admin/listShipping', 'Shipping#listShipping', 'listShipping'],
		['GET|POST', '/admin/addShipping', 'Shipping#addShipping', 'addShipping'],
		['GET|POST', '/admin/updateShipping/[i:id]', 'Shipping#updateShipping', 'updateShipping'],

		//Pages liées à GuestbookController
		['GET|POST', '/admin/listGuestbook', 'Guestbook#listGuestbook', 'listGuestbook'],
		['GET|POST', '/admin/moderation/[i:id]', 'Guestbook#moderation', 'moderation'],



/******************** FRONT *********************/

//Routes pour le front (classé par controller)

		// Routes en Ajax Front
		['GET|POST', '/ajax/login', 'AjaxFront#login', 'ajax_Flogin'],
		['GET|POST', '/ajax/logout', 'AjaxFront#logout', 'ajax_Flogout'],

		//Pages liées à FrontController
		['GET|POST', '/home', 'Front#index', 'front_index'],
		['GET|POST', '/aPropos', 'Front#about', 'front_aPropos'],
		['GET|POST', '/cgv', 'Front#cgv', 'front_cgv'],
		['GET|POST', '/contact', 'Front#contact', 'front_contact'],
		['GET|POST', '/legalMention', 'Front#legalMention', 'front_legalMention'],
		['GET|POST', '/events', 'Front#events', 'front_events'],

		//Pages liées à UserController
		['GET|POST', '/inscription', 'FrontUser#faddUser', 'front_faddUser'],
		['GET|POST', '/compte/[i:id]', 'FrontUser#affCptUser', 'front_affcptuser'],
		['GET|POST', '/updateCompte/[i:id]', 'FrontUser#fupdateUser', 'front_fUpdateUser'],
		['GET|POST', '/orderLogin', 'FrontUser#fconnectUser', 'front_orderLogin'],


		//Pages liées à FrontItemController
		['GET|POST', '/Classics', 'FrontItem#listItemClassics', 'listItemClassicsFull'],
		['GET|POST', '/Classics/[a:sub_category]', 'FrontItem#listItemClassics', 'listItemClassics'],
		['GET|POST', '/Customs/[a:sub_category]', 'FrontItem#listItemCustoms', 'listItemCustoms'],
		['GET|POST', '/Divers/[a:sub_category]', 'FrontItem#listItemDivers', 'listItemDivers'],
		['GET|POST', '/Pieces/[a:sub_category]', 'FrontItem#listItemPieces', 'listItemPieces'],
		['GET|POST', '/searchItems', 'FrontItem#searchItems', 'searchItems'],

		//Pages liées à FrontGuestbookController
		['GET|POST', '/Guestbook', 'FrontGuestbook#affGuestbook', 'fGuestbook'],


		//Pages liées à FrontOrdersController du COMPTE CLIENT
			//liste des commandes
		['GET|POST', '/listOrders', 'FrontOrders#frontListOrders', 'front_listOrders'],
			//vue d'une commande
		['GET|POST', '/viewOrder', 'FrontOrders#frontViewOrders', 'front_viewUserOrder'],


		//Pages liées à FrontOrdersController du PROCESS COMMANDE
			//commande du panier
		['GET|POST', '/orderList', 'FrontOrders#frontPanier', 'front_orderList'],
			//choix du mode de paiement
		['GET|POST', '/orderPayment', 'FrontOrders#frontOrderPaie', 'front_orderPayment'],
			//Page choix de l'adresse de livraison
		['GET|POST', '/orderAddress', 'FrontOrders#frontOrderAddress', 'front_orderAddress'],

	);