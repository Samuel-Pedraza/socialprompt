// document.getElementById("element").addEventListener("mouseover", function(){
//   document.getElementById("typewriter").classList.add("typewriter");
// });

document.getElementById("tweetthis").addEventListener("click", function(){
	var tweet = document.getElementById("texttweet").value;
	window.open('https://twitter.com/intent/tweet?text=' + tweet, 'essb_share_window', 'height=300,width=500,resizable=1,scrollbars=yes');

	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", document.location.origin + '/wp-admin/admin-ajax.php', true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("action=updatesocialsharecount");

});