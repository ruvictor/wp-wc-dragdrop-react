const PlaceOrderButton = (props) => {
    // console.log(props);

    let URL = '?add-to-cart=';
    Object.keys(props.days).map((day) => {
        
        return props.days[day].productIds.length > 0 ?
            props.days[day].productIds.map((id) => {
                URL = URL + id + ':' + day + ',';
                return URL;
            }) : '';
    });

    return (
        <a style={{'color':'white'}} href={URL.slice(0, -1)}>place order</a>
    );
}

export default PlaceOrderButton;