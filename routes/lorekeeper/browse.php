<?php

/*
|--------------------------------------------------------------------------
| Browse Routes
|--------------------------------------------------------------------------
|
| Routes for pages that don't require being logged in to view,
| specifically the information pages.
|
*/

/**************************************************************************************************
    Widgets
**************************************************************************************************/

Route::get('items/{id}', 'Users\InventoryController@getStack');
Route::get(__('awards.awardcase').'/{id}', 'Users\AwardCaseController@getStack');
Route::get('pets/{id}', 'Users\PetController@getStack');
Route::get('items/character/{id}', 'Users\InventoryController@getCharacterStack');
Route::get(__('awards.awards').'/character/{id}', 'Users\AwardCaseController@getCharacterStack');

/**************************************************************************************************
    News
**************************************************************************************************/
// PROFILES
Route::group(['prefix' => 'news'], function () {
    Route::get('/', 'NewsController@getIndex');
    Route::get('{id}.{slug?}', 'NewsController@getNews');
    Route::get('{id}.', 'NewsController@getNews');
});

/**************************************************************************************************
    Sales
**************************************************************************************************/
// PROFILES
Route::group(['prefix' => 'sales'], function () {
    Route::get('/', 'SalesController@getIndex');
    Route::get('{id}.{slug?}', 'SalesController@getSales');
    Route::get('{id}.', 'SalesController@getSales');
});

/**************************************************************************************************
    Users
**************************************************************************************************/
Route::get('/users', 'BrowseController@getUsers');
Route::get('/blacklist', 'BrowseController@getBlacklist');
Route::get('/deactivated-list', 'BrowseController@getDeactivated');

// PROFILES
Route::group(['prefix' => 'user', 'namespace' => 'Users'], function () {
    Route::get('{name}/gallery', 'UserController@getUserGallery');
    Route::get('{name}/favorites', 'UserController@getUserFavorites');
    Route::get('{name}/favorites/own-characters', 'UserController@getUserOwnCharacterFavorites');

    Route::get('{name}', 'UserController@getUser');
    Route::get('{name}/aliases', 'UserController@getUserAliases');
    Route::get('{name}/characters', 'UserController@getUserCharacters');
    Route::get('{name}/sublist/{key}', 'UserController@getUserSublist');
    Route::get('{name}/myos', 'UserController@getUserMyoSlots');
    Route::get('{name}/inventory', 'UserController@getUserInventory');
    Route::get('{name}/pets', 'UserController@getUserPets');
    Route::get('{name}/pets/{id}', 'UserController@getUserPet');
    Route::get('{name}/bank', 'UserController@getUserBank');
    Route::get('{name}/'.__('awards.awardcase'), 'UserController@getUserAwardCase');
    Route::get('{name}/currency-logs', 'UserController@getUserCurrencyLogs');
    Route::get('{name}/item-logs', 'UserController@getUserItemLogs');
    Route::get('{name}/'.__('awards.award').'-logs', 'UserController@getUserAwardLogs');
    Route::get('{name}/pet-logs', 'UserController@getUserPetLogs');
    Route::get('{name}/ownership', 'UserController@getUserOwnershipLogs');
    Route::get('{name}/submissions', 'UserController@getUserSubmissions');
    Route::get('{name}/redeem-logs', 'UserController@getUserRedeemLogs');
    Route::get('{name}/collection-logs', 'UserController@getUserCollectionLogs');

    Route::get('{name}/recipe-logs', 'UserController@getUserRecipeLogs');
});

/**************************************************************************************************
    Characters
**************************************************************************************************/
Route::get('/masterlist', 'BrowseController@getCharacters');
Route::get('/myos', 'BrowseController@getMyos');
Route::get('/sublist/{key}', 'BrowseController@getSublist');
Route::group(['prefix' => 'character', 'namespace' => 'Characters'], function () {
Route::get('/'.__('character_likes.likes').'-leaderboard', 'BrowseController@getLikesLeaderboard');
    Route::get('{slug}', 'CharacterController@getCharacter');
    Route::get('{slug}/profile', 'CharacterController@getCharacterProfile');
    Route::get('{slug}/'.__('awards.awardcase'), 'CharacterController@getCharacterAwards');
    Route::get('{slug}/comments', 'CharacterController@getCharacterComments');
    Route::get('{slug}/links', 'CharacterController@getCharacterLinks');
    Route::get('{slug}/bank', 'CharacterController@getCharacterBank');
    Route::get('{slug}/inventory', 'CharacterController@getCharacterInventory');
    Route::get('{slug}/images', 'CharacterController@getCharacterImages');

    Route::get('{slug}/'.__('awards.award').'-logs', 'CharacterController@getCharacterAwardLogs');
    Route::get('{slug}/currency-logs', 'CharacterController@getCharacterCurrencyLogs');
    Route::get('{slug}/item-logs', 'CharacterController@getCharacterItemLogs');
    Route::get('{slug}/ownership', 'CharacterController@getCharacterOwnershipLogs');
    Route::get('{slug}/change-log', 'CharacterController@getCharacterLogs');
    Route::get('{slug}/submissions', 'CharacterController@getCharacterSubmissions');
    Route::get('{slug}/gallery', 'CharacterController@getCharacterGallery');
    Route::get('{slug}/image/{id}', 'CharacterController@getCharacterImage');

    # lineage
    Route::get('{slug}/lineage', 'CharacterLineageController@getCharacterLineage');
    Route::get('{slug}/pets', 'CharacterController@getCharacterPets');
});

Route::group(['prefix' => 'myo', 'namespace' => 'Characters'], function () {
    Route::get('{id}', 'MyoController@getCharacter');
    Route::get('{id}/profile', 'MyoController@getCharacterProfile');
    Route::get('{id}/comments', 'MyoController@getCharacterComments');
    Route::get('{id}/ownership', 'MyoController@getCharacterOwnershipLogs');
    Route::get('{id}/change-log', 'MyoController@getCharacterLogs');
});

/**************************************************************************************************
    World
**************************************************************************************************/

Route::group(['prefix' => 'world'], function () {
    Route::get('/', 'WorldController@getIndex');

    Route::get('currencies', 'WorldController@getCurrencies');
    Route::get('rarities', 'WorldController@getRarities');
    Route::get('species', 'WorldController@getSpecieses');
    Route::get('subtypes', 'WorldController@getSubtypes');
    Route::get('species/{id}/traits', 'WorldController@getSpeciesFeatures');
    Route::get('species/{speciesId}/trait/{id}', 'WorldController@getSpeciesFeatureDetail')->where(['id' => '[0-9]+', 'speciesId' => '[0-9]+']);
    Route::get('item-categories', 'WorldController@getItemCategories');
    Route::get('items', 'WorldController@getItems');
    Route::get(__('awards.award').'-categories', 'WorldController@getAwardCategories');
    Route::get(__('awards.awards'), 'WorldController@getAwards');
    Route::get(__('awards.awards').'/{id}', 'WorldController@getAward');
    Route::get('items/{id}', 'WorldController@getItem');
    Route::get('trait-categories', 'WorldController@getFeatureCategories');
    Route::get('traits', 'WorldController@getFeatures');
    Route::get('pet-categories', 'WorldController@getPetCategories');
    Route::get('pets', 'WorldController@getPets');
    Route::get('pets/{id}', 'WorldController@getPet');
    Route::get('character-categories', 'WorldController@getCharacterCategories');
    Route::get(__('transformations.transformations'), 'WorldController@getTransformations');
    Route::get('character-titles', 'WorldController@getCharacterTitles');
    Route::get('character-titles/{name}', 'WorldController@getCharacterTitle');

    Route::get('collections', 'WorldController@getCollections');
    Route::get('collections/{id}', 'WorldController@getCollection');
    Route::get('collection-categories', 'WorldController@getCollectionCategories');
    Route::get('recipes', 'WorldController@getRecipes');
    Route::get('recipes/{id}', 'WorldController@getRecipe');
});

Route::group(['prefix' => 'prompts'], function () {
    Route::get('/', 'PromptsController@getIndex');
    Route::get('prompt-categories', 'PromptsController@getPromptCategories');
    Route::get('prompts', 'PromptsController@getPrompts');
    Route::get('{id}', 'PromptsController@getPrompt');
});

Route::group(['prefix' => 'shops'], function () {
    Route::get('/', 'ShopController@getIndex');
    Route::get('{id}', 'ShopController@getShop')->where(['id' => '[0-9]+']);
    Route::get('{id}/{stockId}', 'ShopController@getShopStock')->where(['id' => '[0-9]+', 'stockId' => '[0-9]+']);
});

Route::group(['prefix' => __('dailies.dailies')], function() {
    Route::get('/', 'DailyController@getIndex');
    Route::get('{id}', 'DailyController@getDaily')->where(['id' => '[0-9]+']);
});


Route::group(['prefix' => __('cultivation.cultivation')], function() {
    Route::get('/', 'CultivationController@getIndex');
    Route::get('/guide', 'CultivationController@getGuide');

});

/**************************************************************************************************
    Site Pages
**************************************************************************************************/
Route::get('credits', 'PageController@getCreditsPage');
Route::get('info/{key}', 'PageController@getPage');

/**************************************************************************************************
    Raffles
**************************************************************************************************/
Route::group(['prefix' => 'raffles'], function () {
    Route::get('/', 'RaffleController@getRaffleIndex');
    Route::get('view/{id}', 'RaffleController@getRaffleTickets');
});

/**************************************************************************************************
    Submissions
**************************************************************************************************/
Route::group(['prefix' => 'submissions', 'namespace' => 'Users'], function () {
    Route::get('view/{id}', 'SubmissionController@getSubmission');
});
Route::group(['prefix' => 'claims', 'namespace' => 'Users'], function () {
    Route::get('view/{id}', 'SubmissionController@getClaim');
});

/**************************************************************************************************
    Comments
**************************************************************************************************/
Route::get('comment/{id}', 'PermalinkController@getComment');

/**************************************************************************************************
    Galleries
**************************************************************************************************/
Route::group(['prefix' => 'gallery'], function () {
    Route::get('/', 'GalleryController@getGalleryIndex');
    Route::get('all', 'GalleryController@getAll');
    Route::get('{id}', 'GalleryController@getGallery');
    Route::get('view/{id}', 'GalleryController@getSubmission');
    Route::get('view/favorites/{id}', 'GalleryController@getSubmissionFavorites');
});

/**************************************************************************************************
    Reports
**************************************************************************************************/
Route::group(['prefix' => 'reports', 'namespace' => 'Users'], function () {
    Route::get('/bug-reports', 'ReportController@getBugIndex');
});

Route::get('time' , function() {
    return date('Y-m-d H:i:s');
});

/**************************************************************************************************
    Terms accept
**************************************************************************************************/
Route::group(['prefix' => 'terms'], function() {
    Route::get('/accept', 'TermsController@acceptTerms');
});

/**************************************************************************************************
    FAQ
**************************************************************************************************/
Route::group(['prefix' => 'faq',], function () {
    Route::get('/{id?}', 'BrowseController@getFaq')->where(['id' => '[0-9]+']);
    Route::get('/modal/{id}', 'BrowseController@getFaqQuestion')->where(['id' => '[0-9]+']);
    Route::get('/search', 'BrowseController@getFaqSearch');
});
