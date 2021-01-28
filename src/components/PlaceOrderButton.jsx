const PlaceOrderButton = (props) => {
    // console.log(props);

    let URL = '?add-to-cart=';
    let prodLength = 0;
    Object.keys(props.days).map((day) => {
        prodLength++;
        // console.log(props.days[day].productIds.length);
        return props.days[day].productIds.length > 0 ?
            props.days[day].productIds.map((id) => {
                URL = URL + id + ':' + day + ',';
                // remove comma from last product
                if(prodLength === 7) URL = URL.slice(0,-1);
                return URL;
            }) : '';
    });

    return (
        <a style={{'color':'white'}} href={URL}>place order</a>
    );
}

export default PlaceOrderButton;