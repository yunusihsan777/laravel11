import React, { useState } from 'react';
import { useForm } from '@inertiajs/react';
import {
    Box,
    Button,
    Card,
    CardContent,
    FormControl,
    InputLabel,
    MenuItem,
    Select,
    Typography,
    Alert,
} from '@mui/material';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';

export default function PilihTahun({ errors }) {
    const { data, setData, post } = useForm({
        tahun: '', // Default value
    });

    const handleSubmit = (e) => {
        e.preventDefault();
        post(route('set.tahun')); // Route defined in TahunController
    };

    const currentYear = new Date().getFullYear();

    return (
        <AuthenticatedLayout
        header={
            <h2 className="text-xl font-semibold leading-tight text-gray-800">
                Dashboard
            </h2>
        }>
        <Box
            sx={{
                minHeight: '100vh',
                display: 'flex',
                justifyContent: 'center',
                alignItems: 'center',
                backgroundImage: 'url(/public/gambar/background.jpg)',
                backgroundSize: 'cover',
                backgroundPosition: 'center',
            }}
        >
            <Card sx={{ width: 400, padding: 3, boxShadow: 3 }}>
                <CardContent>
                    <Typography variant="h5" component="h1" gutterBottom>
                        Pilih Tahun Input Data
                    </Typography>
                    <form onSubmit={handleSubmit}>
                        <FormControl fullWidth sx={{ marginBottom: 2 }}>
                            <InputLabel id="tahun-label">Pilih Tahun</InputLabel>
                            <Select
                                labelId="tahun-label"
                                id="tahun"
                                value={data.tahun}
                                onChange={(e) => setData('tahun', e.target.value)}
                                label="Pilih Tahun"
                            >
                                {[...Array(6)].map((_, index) => {
                                    const year = 2024 + index;
                                    return (
                                        <MenuItem key={year} value={year}>
                                            {year}
                                        </MenuItem>
                                    );
                                })}
                            </Select>
                        </FormControl>
                        <Button
                            type="submit"
                            variant="contained"
                            fullWidth
                            sx={{
                                backgroundColor: '#ead022',
                                '&:hover': { backgroundColor: '#f5e65f' },
                            }}
                        >
                            Simpan
                        </Button>
                    </form>
                    {errors && Object.keys(errors).length > 0 && (
                        <Box mt={2}>
                            <Alert severity="error">
                                <ul style={{ margin: 0, paddingLeft: 20 }}>
                                    {Object.values(errors).map((error, index) => (
                                        <li key={index}>{error}</li>
                                    ))}
                                </ul>
                            </Alert>
                        </Box>
                    )}
                </CardContent>
            </Card>
        </Box>
        </AuthenticatedLayout>
    );
}