import React from 'react';
import TopNav from '../components/TopNav';
import LeftNav from '../components/LeftNav';

const Home = () => {
  return (
    <div className="home">
      <TopNav/>
      <LeftNav/>
      <h1>Bonjour</h1>
    </div>
  );
};

export default Home;