import React from 'react';

function Cart(props) 
{  
    return (
        <div className="card">

            <div className="view overlay">
                <img src={props.image} className="card-img-top" alt=""/>
                <a> <div className="mask rgba-white-slight"></div> </a>
            </div>

            <div className="card-body text-center">
                <a href="" className="grey-text">
                <h5>{props.name}</h5>
                </a>
                <h5>
                <strong>
                    <a href="" className="dark-grey-text">{props.classification}
                    { (props.new=='NEW') ? <span className="badge badge-pill danger-color">{props.new}</span> : '' }
                    </a>
                </strong>
                </h5>

                <h4 className="font-weight-bold blue-text">
                <strong>{props.price}</strong>
                </h4>

            </div>
        </div>

    )//fin return 
}

export default Cart
