<html><head><meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<script src="./js/zepto.min.js" type="text/javascript"></script>
</head>
<body>
<input type="text" id="abc" name="abc" value="123">
</body>
</html>
<script>
$("input:text").click(function(){
$(this).select();
});
</script>
