!function ($, iScroll) {
  $.ender({
    iScroll: function (options) {
      return new iScroll(this[0], options)
    }
  }, true)
}(ender, require('iscroll').iScroll)


           $("#favorite_button").click(function() {
                $.post("../controllers/add_favorite.php", {
                   userID: <?=$userID?>,
                   article_title: <?=$article_title?>,
                   article_source: <?=$article_source?>,
                   pub_date: <?=$article_pub_date?>,
                   description: "<?=htmlspecialchars($article_description)?>"
                }, function() {
                   alert("You Have Favorited this article")
                });
           });