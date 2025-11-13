/**
 * Author: Joseph Juarez
 * Date: 11/04/2025
 * File: Header.jsx
 * Description: create a common page header
 */

import {NavLink} from "react-router-dom";
import {Navbar, Nav, Container} from "react-bootstrap";
import logo from "/src/assets/img/college-icon.png";
import {useAuth} from "../services/useAuth";

//This component creates a React-Bootstrap navbar. https://react-bootstrap.github.io/components/navbar/
const Header = () => {
    const className = ({ isActive }) => isActive ? "nav-link active" : "nav-link";
    const {isAuthed, user} = useAuth();

    return (
        <>
            <Navbar bg="primary" variant="dark" expand="sm">
                <Container>
                    <NavLink to="/">
                        <Navbar.Brand><img src={logo} alt="Logo"/>MyCollege</Navbar.Brand>
                    </NavLink>
                    <Navbar.Toggle aria-controls="basic-navbar-nav" />
                    <Navbar.Collapse id="basic-navbar-nav">
                        <Nav className="me-auto">
                            <NavLink to="/" className={className}>Home</NavLink>

                                <div className="nav-separator">|</div>

                            <NavLink to="/professors" className={className}>Professor</NavLink>

                                <div className="nav-separator">|</div>

                            {isAuthed
                                ? <NavLink to="/signout" className={className}>Sign out</NavLink>
                                : <NavLink to="/signin" className={className}>Sign in/Sign up</NavLink>
                            }

                        </Nav>

                        {isAuthed && user ? <div className="navbar-name">
                            Welcome {user.name}!</div> : ""
                        }

                    </Navbar.Collapse>
                </Container>
            </Navbar>
        </>
    );
}

export default Header;