import React from 'react';
import Cart from './Cart';
    
function Product(props) 
{
    //const name = props.name;
    return (
        /*Section: Products v.3*/
        <section className="text-center mb-4">

            <div className="row wow fadeIn">
                <div className="col-lg-3 col-md-6 mb-4">
                    <Cart image='https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Vertical/12.jpg' name='Shirt' classification='Denim shirt' new='NEW' price='120$'/>
                </div>
            
                <div className="col-lg-3 col-md-6 mb-4">
                    <Cart image='https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Vertical/13.jpg' name='Sweatshirt' classification='Sport wear' new='' price='139$'/>
                </div>

                <div className="col-lg-3 col-md-6 mb-4">
                    <Cart image='https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Vertical/14.jpg' name='Grey blouse' classification='Sport wear' new='bestseller' price='99$'/>
                </div>

                <div className="col-lg-3 col-md-6 mb-4">
                    <Cart image='https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Vertical/15.jpg' name='Black jacket' classification='Outwear' new='' price='219$'/>
                </div>
            </div>

      </section>
      
    ) 
}
    
export default Product;