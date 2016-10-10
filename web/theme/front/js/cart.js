/**
 * Created by an www.sucaijiayuan.com
 */
window.onload = function () {
    if (!document.getElementsByClassName) {
        document.getElementsByClassName = function (cls) {
            var ret = [];
            var els = document.getElementsByTagName('*');
            for (var i = 0, len = els.length; i < len; i++) {

                if (els[i].className.indexOf(cls + ' ') >= 0 || els[i].className.indexOf(' ' + cls + ' ') >= 0 || els[i].className.indexOf(' ' + cls) >= 0) {
                    ret.push(els[i]);
                }
            }
            return ret;
        };
    }
    var selectInputs = document.getElementsByClassName('check'); // 所有勾选框
    var checkAllInputs = document.getElementsByClassName('check-all'); // 全选框
    var tr = document.getElementById("test").getElementsByTagName("li");
    var selectedTotal = document.getElementById('selectedTotal'); //已选商品数目容器
    var priceTotal = document.getElementById('priceTotal'); //总计

//    更新总数和总价格
    function getTotal() {
        var seleted = 0;
        var price = 0;
        for (var i = 0, len = tr.length; i < len; i++) {
            if (tr[i].getElementsByTagName('input')[0].checked) {
                seleted += parseInt(tr[i].getElementsByTagName('input')[3].value);
                price += parseFloat(tr[i].getElementsByTagName('input')[1].value);
                var trr = parseInt(tr[i].getElementsByTagName('input')[3].value);
                var t = parseInt(tr[i].getElementsByTagName('input')[6].value);
                //alert(t);
                if (parseInt(trr) > parseInt(t)) {
                    tr[i].getElementsByTagName('input')[3].value = trr;
                    tr[i].getElementsByTagName('span')[5].innerHTML = "很抱歉，您的宝贝数量超过库存";
                    tr[i].getElementsByTagName('input')[0].checked = false;
                }
//                var p = tr[i].getElementsByTagName('span')[5];
//                //alert("");
//                if (parseInt(seleted) > t) {
//                    p.innerHTML = "很抱歉，库存不足哦";
//                    tr[i].getElementsByTagName('input')[0].checked = false;
//                } else {
//                    p.innerHTML = "";
//                    tr[i].getElementsByTagName('input')[0].checked = true;
//                }


            }
            else {
                tr[i].className = '';
            }
        }
        selectedTotal.innerHTML = seleted;
        priceTotal.innerHTML = price.toFixed(2);

    }

    function getSubtotal(tr) {
        var price = tr.getElementsByTagName('span')[6]; //单价
        var subtotal = tr.getElementsByTagName('input')[1]; //小计td
        var countInput = tr.getElementsByTagName('input')[3]; //数目input
        subtotal.value = (parseInt(countInput.value) * parseFloat(price.innerHTML)).toFixed(2);
        var t = parseInt(tr.getElementsByTagName('input')[6].value);
        var p = tr.getElementsByTagName('span')[5];
//        alert(t);
//        alert(countInput.value);
        if (parseInt(countInput.value) > t) {
            p.innerHTML = "很抱歉，您的宝贝数量超过库存";
            tr.getElementsByTagName('input')[0].checked = false;
        } else {
            p.innerHTML = "";
            tr.getElementsByTagName('input')[0].checked = true;
        }

    }

    //为每行元素添加事件
    for (var i = 0; i < tr.length; i++) {
        //将点击事件绑定到tr元素
        tr[i].onclick = function (e) {
            var e = e || window.event;
            var el = e.target || e.srcElement; //通过事件对象的target属性获取触发元素
            var cls = el.className; //触发元素的class
            var countInout = this.getElementsByTagName('input')[3]; // 数目input
            var value = parseInt(countInout.value); //数目
            //通过判断触发元素的class确定用户点击了哪个元素
            switch (cls) {
                case 'quantity_increase': //点击了加号
                    countInout.value = value + 1;
                    getSubtotal(this);
                    break;
                case 'quantity_decrease': //点击了减号
                    if (value > 1) {
                        countInout.value = value - 1;
                        getSubtotal(this);
                    }
                    break;
            }
            getTotal();
        };
    }

//     点击选择框
    for (var i = 0; i < selectInputs.length; i++) {
        selectInputs[i].onclick = function () {
            if (this.className.indexOf('check-all') >= 0) { //如果是全选，则吧所有的选择框选中
                for (var j = 0; j < selectInputs.length; j++) {
                    selectInputs[j].checked = this.checked;
                }
            }
            if (!this.checked) { //只要有一个未勾选，则取消全选框的选中状态
                for (var i = 0; i < checkAllInputs.length; i++) {
                    checkAllInputs[i].checked = false;
                }
            }
            getTotal();//选完更新总计
        };
    }

    checkAllInputs[0].checked = true;
    checkAllInputs[0].onclick();

};
