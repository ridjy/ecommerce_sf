import React from 'react';
    
function Product(props) 
{
    const name = props.name;
    return (
        <span>
            produit {name}
        </span>
    ) 
}
    
export default Product;