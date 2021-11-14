import React from "react";
import { Switch, Route, BrowserRouter } from "react-router-dom";
import Home from './pages/Home';
import About from './pages/About';
import NoMatch from './pages/NoMatch';


const App = () => {

  return (
    <BrowserRouter>
      <Switch>
        <Route path="/" exact component={Home} />
        <Route path="/about" exact component={About} />
        <Route component={NoMatch} />
      </Switch>
    </BrowserRouter>
  );

};

export default App;