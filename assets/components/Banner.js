import React, {Component} from 'react';



class Banner extends Component { 

    getCategories()
    {

    }

    render() { 
      let categories = ['Shirts','Sport wears','Outwears']
      return (
      <nav className="navbar navbar-expand-lg navbar-dark mdb-color lighten-3 mt-3 mb-5">

        <span className="navbar-brand">Categories:</span>

        <button className="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav"
          aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
          <span className="navbar-toggler-icon"></span>
        </button>

        <div className="collapse navbar-collapse" id="basicExampleNav">

          <ul className="navbar-nav mr-auto">
            <li className="nav-item active" key="1">
              <a className="nav-link" href="#">All
                <span className="sr-only">(current)</span>
              </a>
            </li>
            {categories.map((cat) => (
              <li className="nav-item" key={cat} >
              <a className="nav-link" href="#">{cat}</a>
            </li>
            ) )}

          </ul>

          <form className="form-inline">
            <div className="md-form my-0">
              <input className="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search"/>
            </div>
          </form>
        </div>
        
      </nav>
    )//fin return
  }//fin render  
}

export default Banner