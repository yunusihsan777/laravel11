import * as React from 'react';
import { Link, useForm, usePage } from '@inertiajs/react';
import {
    AppBar,
    Toolbar,
    Typography,
    Select,
    MenuItem,
    Button,
    Box,
    Drawer,
    List,
    ListItem,
    ListItemIcon,
    ListItemText,
    Collapse,
    Divider,
    IconButton,
} from '@mui/material';
import {
    Home as HomeIcon,
    Task as TaskIcon,
    People as PeopleIcon,
    FileCopy as FileCopyIcon,
    BarChart as BarChartIcon,
    CheckCircle as CheckCircleIcon,
    ExpandLess,
    ExpandMore,
    Menu as MenuIcon,
    Close as CloseIcon,
} from '@mui/icons-material';

export default function AuthenticatedLayout({ header, children }) {
    const { auth, tahun: sessionTahun } = usePage().props; // Ambil data user dan tahun dari backend
    const user = auth.user;

    const [submenuOpen, setSubmenuOpen] = React.useState(false);
    const [drawerOpen, setDrawerOpen] = React.useState(true); // Sidebar default terbuka

    const toggleSubmenu = () => {
        setSubmenuOpen(!submenuOpen);
    };

    const toggleDrawer = () => {
        setDrawerOpen(!drawerOpen); // Toggle state drawerOpen
    };

    const { data, setData, post } = useForm({
        tahun: sessionTahun || new Date().getFullYear(), // Default tahun
    });

    const handleTahunChange = (event) => {
        setData('tahun', event.target.value); // Perbarui data tahun
        post(route('set.tahun')); // Kirim data ke backend
    };

    return (
        <Box sx={{ display: 'flex' }}>
            {/* Tombol Toggle Sidebar */}
            <IconButton
                onClick={toggleDrawer}
                sx={{
                    position: 'fixed',
                    top: 16,
                    left: drawerOpen ? 260 : 16, // Geser tombol sesuai posisi sidebar
                    zIndex: 1300,
                    backgroundColor: 'white',
                    boxShadow: 2,
                }}
            >
                {drawerOpen ? <CloseIcon /> : <MenuIcon />}
            </IconButton>

            {/* Sidebar */}
            <Drawer
                variant="persistent"
                open={drawerOpen}
                sx={{
                    width: drawerOpen ? 250 : 0,
                    flexShrink: 0,
                    [`& .MuiDrawer-paper`]: {
                        width: 250,
                        boxSizing: 'border-box',
                        transition: 'width 0.3s',
                    },
                }}
            >
                <Box textAlign="center" mt={2}>
                    <img
                        src="/gambar/kejaksaan.png"
                        alt="Profile"
                        style={{ width: 100, height: 100, borderRadius: '50%' }}
                    />
                    <Typography variant="h6" color="textPrimary">
                        Selamat Datang
                    </Typography>
                    <Typography variant="body2" color="textSecondary">
                        {user.satkernama.replace(/_/g, ' ')}
                    </Typography>
                    <Typography variant="body2" color="textSecondary">
                        ID Satker: {user.id_satker}
                    </Typography>
                </Box>
                <Divider />
                <List>
                    <ListItem button component={Link} href={route('dashboard')}>
                        <ListItemIcon>
                            <HomeIcon />
                        </ListItemIcon>
                        <ListItemText primary="Beranda" />
                    </ListItem>
                    {(user.id_sakip_level === 99 || user.id_sakip_level === 2 || user.id_sakip_level === 3) && (
                        <>
                            <ListItem button onClick={toggleSubmenu}>
                                <ListItemIcon>
                                    <TaskIcon />
                                </ListItemIcon>
                                <ListItemText primary="Tata Kelola AKIP" />
                                {submenuOpen ? <ExpandLess /> : <ExpandMore />}
                            </ListItem>
                            <Collapse in={submenuOpen} timeout="auto" unmountOnExit>
                                <List component="div" disablePadding>
                                    <ListItem button component={Link} href={route('kep')}>
                                        <ListItemIcon>
                                            <PeopleIcon />
                                        </ListItemIcon>
                                        <ListItemText primary="Kep Tim SAKIP" />
                                    </ListItem>
                                    <ListItem button component={Link} href={route('perencanaan')}>
                                        <ListItemIcon>
                                            <FileCopyIcon />
                                        </ListItemIcon>
                                        <ListItemText primary="Perencanaan" />
                                    </ListItem>
                                    {user.id_sakip_level === 99 && (
                                        <ListItem button component={Link} href={route('pengukuran')}>
                                            <ListItemIcon>
                                                <BarChartIcon />
                                            </ListItemIcon>
                                            <ListItemText primary="Pengukuran" />
                                        </ListItem>
                                    )}
                                    <ListItem button component={Link} href={route('pelaporan')}>
                                        <ListItemIcon>
                                            <FileCopyIcon />
                                        </ListItemIcon>
                                        <ListItemText primary="Pelaporan" />
                                    </ListItem>
                                    {user.id_sakip_level === 99 && (
                                        <ListItem button component={Link} href={route('evaluasi')}>
                                            <ListItemIcon>
                                                <CheckCircleIcon />
                                            </ListItemIcon>
                                            <ListItemText primary="Evaluasi" />
                                        </ListItem>
                                    )}
                                </List>
                            </Collapse>
                        </>
                    )}
                </List>
                <Divider />
                <Typography variant="body2" color="textSecondary" align="center" mt={2}>
                    Panev BiroCana Kejaksaan RI @2024
                </Typography>
            </Drawer>

            {/* Main Content */}
            <Box
                sx={{
                    flexGrow: 1,
                    marginLeft: drawerOpen ? 250 : 0, // Geser konten utama sesuai lebar sidebar
                    transition: 'margin-left 0.3s', // Tambahkan transisi untuk animasi
                }}
            >
                {/* Navbar */}
                <AppBar
                    position="fixed"
                    color="default"
                    elevation={1}
                    sx={{
                        marginLeft: drawerOpen ? 250 : 0, // Geser navbar sesuai lebar sidebar
                        width: drawerOpen ? `calc(100% - 250px)` : '100%', // Sesuaikan lebar navbar
                        transition: 'margin-left 0.3s, width 0.3s', // Tambahkan transisi untuk animasi
                    }}
                >
                    <Toolbar>
                        <Typography variant="h6" sx={{ flexGrow: 1 }}>
                            {user.satkernama.replace(/_/g, ' ')}
                        </Typography>
                        <Box sx={{ display: 'flex', alignItems: 'center', gap: 2 }}>
                            <Select
                                value={data.tahun} // Gunakan data dari useForm
                                onChange={handleTahunChange}
                                displayEmpty
                                sx={{ minWidth: 120 }}
                            >
                                <MenuItem value="" disabled>
                                    Pilih Tahun
                                </MenuItem>
                                {[...Array(6)].map((_, index) => {
                                    const tahun = 2024 + index;
                                    return (
                                        <MenuItem key={tahun} value={tahun}>
                                            {tahun}
                                        </MenuItem>
                                    );
                                })}
                            </Select>
                            <form action={route('logout')} method="POST">
                                <Button type="submit" variant="contained" color="error">
                                    Logout
                                </Button>
                            </form>
                        </Box>
                    </Toolbar>
                </AppBar>

                {/* Page Content */}
                <Box sx={{ padding: 3, marginTop: 8 }}>{children}</Box>
            </Box>
        </Box>
    );
}