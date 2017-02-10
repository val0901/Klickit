<?php
	
	$w_routes = array(
		['GET', '/', 'Default#home', 'default_home'],
		['GET', 'errors/404', 'Default#notFound', 'default_notFound'],

/******************** BACK *********************/

		//Routes pour le back (classé par controller)
		['GET|POST', '/admin/home', 'Back#index', 'back_index'],
		['GET|POST', '/forgot_password', 'Back#forgot_pwd', 'back_forgot_pwd'],

		//Pages liées à ResetController
		['GET|POST', '/reset_password/[:id_token]/[:token]/', 'Reset#reset_pwd', 'back_reset_pwd'],

		// Les routes ajax
		['GET|POST', '/ajax/logout', 'Ajax#logout', 'ajax_logout'],
		['GET|POST', '/ajax/deleteUser', 'Ajax#deleteUser', 'ajax_deleteUser'],
		['GET|POST', '/ajax/deleteItem', 'Ajax#deleteItem', 'ajax_deleteItem'],
		['GET|POST', '/ajax/deleteMessage', 'Ajax#deleteMessage', 'ajax_deleteMessage'],
		['GET|POST', '/ajax/deleteEvent', 'Ajax#deleteEvent', 'ajax_deleteEvent'],
		['GET|POST', '/ajax/delete/moderation', 'Ajax#deleteMessageMod', 'ajax_delete_message_mod'],
		['GET|POST', '/ajax/deleteSlide', 'Ajax#deleteSlide', 'ajax_deleteSlide'],
		['GET|POST', '/ajax/deleteShipping', 'Ajax#deleteShipping', 'ajax_deleteShipping'],
		['GET|POST', '/ajax/updateStatut', 'Ajax#updateStatus', 'ajax_updateStatus'], // /ajax/updateOrder' que j'ai modifié en '/ajax/updateStatut' pour éviter les conflits
		['GET|POST', '/ajax/deleteOrder', 'Ajax#deleteOrder', 'ajax_deleteOrder'],
		['GET|POST', '/ajax/searchUser', 'Ajax#searchUser', 'ajax_searchUser'],
		['GET|POST', '/ajax/searchMessage', 'Ajax#searchMessage', 'ajax_searchMessage'],
		['GET|POST', '/ajax/searchOrder', 'Ajax#searchOrder', 'ajax_searchOrder'],
		['GET|POST', '/ajax/deleteFilter', 'Ajax#deleteFilter', 'ajax_deleteFilter'],
		['GET|POST', '/ajax/addFilter', 'Ajax#addFilter', 'ajax_addFilter'],
		['GET|POST', '/ajax/updateFilter', 'Ajax#updateFilter', 'ajax_updateFilter'],
		['GET|POST', '/ajax/UpdateItemFilter', 'Ajax#UpdateItemFilter', 'ajax_UpdateItemFilter'],
		['GET|POST', '/ajax/orderUpdateStatut', 'Ajax#orderUpdateStatut', 'ajax_orderUpdateStatut'],

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

		//Pages liées à FilterController
		['GET|POST', '/admin/listFilter', 'Filter#listFilter', 'listFilter'],
		['GET|POST', '/admin/addFilter', 'Filter#addFilter', 'addFilter'],
		['GET|POST', '/admin/updateFilter/[i:id]', 'Filter#updateFilter', 'updateFilter'],

		// Pages chiffre d'affaire
		['GET|POST', '/admin/listSales', 'Sales#listSales', 'listSales'],



/******************** FRONT *********************/

//Routes pour le front (classé par controller)

		// Routes en Ajax Front
		['GET|POST', '/ajax/logout', 'AjaxFront#logout', 'ajax_Flogout'],
		['GET|POST', '/ajax/addToCart', 'AjaxFront#addToCart', 'ajax_addToCart'],
		['GET|POST', '/ajax/addToCartView', 'AjaxFront#addToCartView', 'ajax_addToCartView'],
		['GET|POST', '/ajax/favorite', 'AjaxFront#favorite', 'ajax_favorite'],
		['GET|POST', '/ajax/deleteAllFavorite', 'AjaxFront#deleteAllFavorite', 'ajax_deleteAllFavorite'],
		['GET|POST', '/ajax/deleteArt', 'AjaxFront#deleteArt', 'ajax_deleteArt'],
		['GET|POST', '/ajax/newOrder', 'AjaxFront#newOrder', 'ajax_newOrder'],
		['GET|POST', '/ajax/updateOrder', 'AjaxFront#updateOrder', 'ajax_updateOrder'],
		['GET|POST', '/ajax/updateCountry', 'AjaxFront#updateCountry', 'ajax_updateCountry'],
		['GET|POST', '/ajax/updateOrderAddress', 'AjaxFront#updateOrderAddress', 'ajax_updateOrderAddress'],
		['GET|POST', '/ajax/updateOrderPayment', 'AjaxFront#updateOrderPayment', 'ajax_updateOrderPayment'],
		['GET|POST', '/ajax/updateQuantity', 'AjaxFront#updateQuantity', 'ajax_updateQuantity'],
		['GET|POST', '/ajax/updateQuantitySubtraction', 'AjaxFront#updateQuantitySubtraction', 'ajax_updateQuantitySubtraction'],
		['GET|POST', '/ajax/SearchByFilter', 'AjaxFront#SearchByFilter', 'ajax_SearchByFilter'],
		['GET|POST', '/ajax/resetCountryOrder', 'AjaxFront#resetCountryOrder', 'ajax_resetCountryOrder'],
		['GET|POST', '/ajax/globalSearch', 'AjaxFront#globalSearch', 'ajax_globalSearch'],

		//Pages liées à FrontController
		['GET|POST', '/home', 'Front#index', 'front_index'],
		['GET|POST', '/connexion', 'Front#login', 'login'],
		['GET|POST', '/aPropos', 'Front#about', 'front_aPropos'],
		['GET|POST', '/cgv', 'Front#cgv', 'front_cgv'],
		['GET|POST', '/contact', 'Front#contact', 'front_contact'],
		['GET|POST', '/legalMention', 'Front#legalMention', 'front_legalMention'],
		['GET|POST', '/events', 'Front#events', 'front_events'],
		['GET|POST', '/event/createEvent', 'FrontEvent#createEvent', 'front_createEvent'],
		['GET|POST', '/team', 'Front#team', 'front_team'],
		['GET|POST', '/reloadBasket', 'Front#reloadBasket', 'reloadBasket'],

		//Pages liées à UserController
		['GET|POST', '/inscription', 'FrontUser#faddUser', 'front_faddUser'],
		['GET|POST', '/compte/[i:id]', 'FrontUser#affCptUser', 'front_affcptuser'],
		['GET|POST', '/updateCompte/[i:id]', 'FrontUser#fupdateUser', 'front_fUpdateUser'],
		['GET|POST', '/orderLogin', 'FrontUser#fconnectUser', 'front_orderLogin'],


		//Pages liées à FrontItemController

		['GET|POST', '/Classics', 'FrontItem#listClassicsItemsFull', 'listItemClassicsFull'],
		['GET|POST', '/Classics/[a:sub_category]', 'FrontItem#listItemClassics', 'listItemClassics'],

		['GET|POST', '/Customs', 'FrontItem#listCustomItemsFull', 'listItemCustomFull'],
		['GET|POST', '/Customs/[a:sub_category]', 'FrontItem#listItemCustoms', 'listItemCustoms'],

		['GET|POST', '/Divers', 'FrontItem#listDiversItemsFull', 'listItemDiversFull'],
		['GET|POST', '/Divers/[a:sub_category]', 'FrontItem#listItemDivers', 'listItemDivers'],

		['GET|POST', '/Pieces', 'FrontItem#listPiecesItemsFull', 'listItemPiecesFull'],
		['GET|POST', '/Pieces/[a:sub_category]', 'FrontItem#listItemPieces', 'listItemPieces'],
		
		['GET|POST', '/searchItems', 'FrontItem#searchItems', 'searchItems'],
		['GET|POST', '/viewArt/[i:id]', 'FrontItem#viewItem', 'viewArt'],
		['GET|POST', '/favorite/[i:id]', 'FrontItem#viewFavorites', 'favorite'],

		//Pages liées à FrontGuestbookController
		['GET|POST', '/Guestbook', 'FrontGuestbook#affGuestbook', 'fGuestbook'],

		//Pages liées à FrontOrdersController du COMPTE CLIENT
			//liste des commandes
		['GET|POST', '/listOrders', 'FrontOrders#frontListOrders', 'front_listOrders'],
			//vue d'une commande
		['GET|POST', '/viewOrder/[i:id]', 'FrontOrders#frontViewOrders', 'front_viewUserOrder'],
		['GET|POST', '/pdfOrder/[i:id]', 'FrontOrders#frontpdfOrders', 'front_pdfOrder'],


		//Pages liées à FrontOrdersController du PROCESS COMMANDE
			//commande du panier
		['GET|POST', '/my_order', 'FrontOrders#frontPanier', 'front_orderList'],
			//choix du mode de paiement
		['GET|POST', '/orderPayment', 'FrontOrders#frontOrderPaie', 'front_orderPayment'],
			//Page choix de l'adresse de livraison
		['GET|POST', '/orderAddress', 'FrontOrders#frontOrderAddress', 'front_orderAddress'],
		['GET|POST', '/pay', 'FrontOrders#pay', 'front_pay'],

	);