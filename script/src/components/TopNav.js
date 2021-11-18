import React from 'react';
import { NavLink } from 'react-router-dom';

const TopNav = () => {
  return (
    <div className="topNavigation">
        <NavLink exact to="/" activeClassName="nav-active">Home</NavLink>
        <NavLink exact to="about" activeClassName="nav-active">About</NavLink>
    </div>
  );
};

export default TopNav;