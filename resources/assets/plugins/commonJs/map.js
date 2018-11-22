// 地图定位
var position = document.getElementById('position');
var map = new BMap.Map('map');
if (position.value) {
    var coordinate = $('#coordinate').val()
    var positionPoint = {}
    positionPoint.lng = coordinate.split(',')[0]
    positionPoint.lat = coordinate.split(',')[1]
    var point = new BMap.Point(positionPoint.lng, positionPoint.lat)
    map.centerAndZoom(point, 20)
    var marker = new BMap.Marker(point)
    map.addOverlay(marker)
    map.enableScrollWheelZoom(true);
} else {
    map.centerAndZoom(new BMap.Point(113.331189,23.112153), 20);
    map.enableScrollWheelZoom(true);
}
function hasMap() {
    var hasMap = document.getElementById('hasMap')
    var mapWrap = document.getElementById('mapWrap')
    if (hasMap.innerHTML === '隐藏地图') {
        mapWrap.style.display = 'none';
        hasMap.innerHTML = '显示地图'
    } else {
        mapWrap.style.display = 'block';
        hasMap.innerHTML = '隐藏地图'
    }
}
// 建立一个自动完成的对象
var ac = new BMap.Autocomplete(
    {
        'input' : 'searchId',
        'location' : map
    }
);
var myValue;
ac.addEventListener('onconfirm', function(e) {
    console.log(e);
    position.value = ''
    var _value = e.item.value;
    myValue = _value.province +  _value.city +  _value.district +  _value.street +  _value.business;
    setPlace(_value.city);
});
function setPlace (city) {
    // 创建地址解析器实例
    var myGeo = new BMap.Geocoder();
    // 将地址解析结果显示在地图上,并调整地图视野
    myGeo.getPoint(myValue, function(point) {
    // 获取输入地址的地理位置坐标
        if (point) {
            map.centerAndZoom(point, 20);
            map.addOverlay(new BMap.Marker(point));
        }
    }, city);
}
// 点击地图
map.addEventListener('click', function (e) {
    console.log(e);
    $('#coordinate').val(e.point.lng + ',' + e.point.lat)
    $('#userDefined').show()
    var myGeo = new BMap.Geocoder()
    myGeo.getLocation(new BMap.Point(e.point.lng, e.point.lat), function(rs){
        var addComp = rs.addressComponents;
        var address = addComp.province + addComp.city + addComp.district + addComp.street + addComp.streetNumber
        position.value = address
    })
})