/**
 * Author: Joseph Juarez
 * Date: 11/05/2025
 * File: routes.jsx
 * Description: Defines app routes.
 */

import {BrowserRouter,Routes,Route}from "react-router-dom";
import Layout from "../components/Layout";
import Home from "../pages/home";
import NoMatch from "../pages/nomatch";
import Professors from "../pages/professor/professors.jsx";
import Professor from "../pages/professor/professor.jsx";
import Classes from "../pages/class/classes.jsx";
import {AuthProvider} from "../services/useAuth.jsx";
import Signin from "../pages/auth/signin.jsx";
import Signout from "../pages/auth/signout.jsx";
import Signup from "../pages/auth/signup.jsx";
import RequireAuth from "../components/RequireAuth";

const AppRoutes = () => {
    return (

        <BrowserRouter>
            <AuthProvider>
                <Routes>
                    <Route path="/" element={<Layout/>}>
                        <Route index element={<Home/>}/>

                        <Route path="professors" element={
                            <RequireAuth>
                                <Professors/>
                            </RequireAuth>
                        }>
                                <Route index element={<p>Select a professor to view details.</p>}/>

                                <Route path=":professorId" element={<Professor/>}>
                                    <Route path="classes" element={<Classes />}/>
                                </Route>
                        </Route>

                        <Route path="/signin" element={<Signin/>}/>
                        <Route path="/signout" element={<Signout/>}/>
                        <Route path="/signup" element={<Signup/>}/>

                        <Route path="*" element={<NoMatch/>}/>
                    </Route>
                </Routes>
            </AuthProvider>
        </BrowserRouter>

    );
};

export default AppRoutes;