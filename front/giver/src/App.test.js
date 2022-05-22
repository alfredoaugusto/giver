import React from 'react';
import { render, screen } from '@testing-library/react';
import App from './App';
import { shallow, mount } from 'enzyme';
import Adapter from 'enzyme-adapter-react-15';

configure({adapter: new Adapter()});

test('renders learn react link', () => {
  let wrapper = mount(<App />);

  expect(wrapper.find(App)).to.have.length(1);
});
