//Instagram Api Fetching With Access Code
let  widget_item_show = Number($('#insta_item').val());
var userFeed = new Instafeed({
get: 'user',
target: "instafeed-container",
resolution: 'low_resolution',
limit: widget_item_show,
accessToken: '{{get_static_option('instagram_access_token')}}'
});
userFeed.run();